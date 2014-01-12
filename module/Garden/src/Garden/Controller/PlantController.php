<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\FormInterface;

class PlantController extends AbstractActionController {

    protected $em;

    protected function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function createAction() {

        $months = array(1 => 'jan',
            2 => 'feb',
            3 => 'mrt',
            4 => 'apr',
            5 => 'mei',
            6 => 'jun',
            7 => 'jul',
            8 => 'aug',
            9 => 'sep',
            10 => 'okt',
            11 => 'nov',
            12 => 'dec');

        $form = new \Garden\Form\CreatePlantForm("Create");
        $plant = new \Garden\Entity\Plants();

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
        }
        else
        {
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
        }
        else
        {
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
        $form = new \Garden\Form\CreateHabitatForm("Edit Habitat");
        $form->setLabel("Groeiplaats aanpassen");
        $form->get('submit')->setValue('Pas aan');

        $id = $this->params('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitat = $repository->find($id);

        $form->bind($habitat);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($habitat);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/habitat/index');
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitat = $repository->find($id);

        $this->getEntityManager()->remove($habitat);
        $this->getEntityManager()->flush();

        return $this->redirect()->toUrl('/habitat/index');
    }

}
