<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;

class PlantController extends AbstractActionController {

    protected $em;
    protected $config;

    protected function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    protected function getConfig() {
        if (!isset($this->config)) {
            $this->config = $this->getServiceLocator()->get('config');
        }

        return $this->config;
    }

    protected function getConfigItem($item) {
        $config = $this->getConfig();
        return $config[$item];
    }

    public function createAction() {
        $months = $this->getConfigItem('months');

        $form = new \Garden\Form\CreatePlantForm("Create");
        $plant = new \Garden\Entity\Plants();

        $form->setAttribute('class', 'form-horizontal form-box');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Names');
        $names = $repository->findAll();
        $namesArray = array();
        foreach ($names as $name) {
            $namesArray[$name->getId()] = $name->getDutchName();
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $features = $repository->findAll();
        $featuresArray = array();
        foreach ($features as $feature) {
            $featuresArray[$feature->getId()] = $feature->getFeature();
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitats = $repository->findAll();
        $habitatsArray = array();
        foreach ($habitats as $habitat) {
            $habitatsArray[$habitat->getId()] = $habitat->getHabitat();
        }

        $form->setLabel("Nieuwe Tuinplant");
        $form->get('submit')->setValue('Voeg toe');

        $form->get('name')->setAttributes(array(
            'options' => $namesArray,
        ));

        $form->get('blooming_start')->setAttributes(array(
            'options' => $months,
        ));

        $form->get('blooming_end')->setAttributes(array(
            'options' => $months,
        ));

        $form->get('features')->setAttributes(array(
            'options' => $featuresArray,
        ));

        $form->get('habitats')->setAttributes(array(
            'options' => $habitatsArray,
        ));

        $form->bind($plant);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
                $repository = $this->getEntityManager()->getRepository('Garden\Entity\Names');
                $nameObj = $repository->find($data['name']);
                $data['name'] = $nameObj;
                $plant->setPlant($data);

                $features = $data['features'];
                $habitats = $data['habitats'];

                $this->addFeatures($plant, $features);
                $this->addHabitats($plant, $habitats);

                $this->getEntityManager()->persist($plant);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/');
            }
        }

        return array(
            'form' => $form,
        );
    }

    private function addFeatures(\Garden\Entity\Plants $plant, $features) {
        if (empty($features))
            return;

        if (is_array($features)) {
            foreach ($features as $featureId) {
                $this->addFeature($plant, $featureId);
            }
        } else {
            $this->addFeature($plant, $features);
        }
    }

    private function addFeature(\Garden\Entity\Plants $plant, $featureId) {
        // find feature for this featureId
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $featureObj = $repository->find($featureId);

        // create new PlantsFeatures entry
        $plantsfeature = new \Garden\Entity\PlantsFeatures($plant, $featureObj);
        $this->getEntityManager()->persist($plantsfeature);

        // add new PlantsFeature for this plant
        $plant->addPlantsFeature($plantsfeature);
    }

    private function addHabitats(\Garden\Entity\Plants $plant, $habitats) {
        if (empty($habitats))
            return;

        if (is_array($habitats)) {
            foreach ($habitats as $habitatId) {
                $this->addHabitat($plant, $habitatId);
            }
        } else {
            $this->addHabitat($plant, $habitats);
        }
    }

    private function addHabitat(\Garden\Entity\Plants $plant, $habitatId) {
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitatObj = $repository->find($habitatId);

        $plantshabitat = new \Garden\Entity\PlantsHabitats($plant, $habitatObj);
        $this->getEntityManager()->persist($plantshabitat);

        $plant->addPlantsHabitat($plantshabitat);
    }

    public function editAction() {
        $months = $this->getConfigItem('months');

        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Names');
        $names = $repository->findAll();
        $namesArray = array();
        foreach ($names as $name) {
            $namesArray[$name->getId()] = $name->getDutchName();
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $features = $repository->findAll();
        $featuresArray = array();
        foreach ($features as $feature) {
            $featuresArray[$feature->getId()] = $feature->getFeature();
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitats = $repository->findAll();
        $habitatsArray = array();
        foreach ($habitats as $habitat) {
            $habitatsArray[$habitat->getId()] = $habitat->getHabitat();
        }

        $form = new \Garden\Form\CreatePlantForm("Edit");
        $form->setBindOnValidate(false);
        $form->bind($plant);
        $form->setLabel("Tuinplant aanpassen");
        $form->get('submit')->setValue('Pas aan');
        $form->setAttribute('class', 'form-horizontal form-box');

        $form->get('planting_date')->setValue($plant->getPlantingDate());

        $form->get('name')->setAttributes(array(
            'options' => $namesArray,
        ));

        $form->get('blooming_start')->setAttributes(array(
            'options' => $months,
        ));

        $form->get('blooming_end')->setAttributes(array(
            'options' => $months,
        ));

        $form->get('features')->setAttributes(array(
            'options' => $featuresArray,
        ));

        $form->get('habitats')->setAttributes(array(
            'options' => $habitatsArray,
        ));

        $form->get('name')->setValue($plant->getNameId());
        $form->get('blooming_start')->setOptions(array($plant->getBloomingStart()));
        $form->get('blooming_end')->setOptions(array($plant->getBloomingEnd()));
        $form->get('features')->setValue($plant->getFeatureIds());
        $form->get('habitats')->setValue($plant->getHabitatIds());

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                // remove old features and habitats
                $this->deleteFeatures($plant);
                $this->deleteHabitats($plant);

                $form->bindValues();
                $data = $form->getData(FormInterface::VALUES_AS_ARRAY);
                $repository = $this->getEntityManager()->getRepository('Garden\Entity\Names');
                $nameObj = $repository->find($data['name']);
                $data['name'] = $nameObj;
                $plant->exchangeArray($data);

                // add features and habitats
                $features = $data['features'];
                $habitats = $data['habitats'];

                $this->addFeatures($plant, $features);
                $this->addHabitats($plant, $habitats);

                $this->getEntityManager()->flush();

                // Redirect to list of albums
                return $this->redirect()->toUrl('/');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );

    }

    private function deleteFeatures(\Garden\Entity\Plants $plant) {
        $q = $this->getEntityManager()->createQuery('delete from Garden\Entity\PlantsFeatures p where p.plant = ' . $plant->getId());
        $q->execute();
    }

    private function deleteHabitats(\Garden\Entity\Plants $plant) {
        $q = $this->getEntityManager()->createQuery('delete from Garden\Entity\PlantsHabitats p where p.plant = ' . $plant->getId());
        $q->execute();
    }

    public function deleteAction() {
        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $this->deleteFeatures($plant);
        $this->deleteHabitats($plant);

        $q = $this->getEntityManager()->createQuery('delete from Garden\Entity\Plants p where p.id = ' . $plant->getId());
        $q->execute();

        $this->getEntityManager()->flush();

        return $this->redirect()->toUrl('/');
    }

}
