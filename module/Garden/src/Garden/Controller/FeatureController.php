<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FeatureController extends AbstractActionController {

    protected $em;

    protected function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {
        // get all used features
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\PlantsFeatures');
        $featuresWithPlants = $repository->findAll();

        $featuresUsed = array();
        foreach ($featuresWithPlants as $feature) {
            if (!in_array($feature->getFeatureId(), $featuresUsed)) {
                $featuresUsed[] = $feature->getFeatureId();
            }
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $features = $repository->findAll();

        return array(
            'features' => $features,
            'featuresUsed' => $featuresUsed
        );
    }

    public function createAction() {
        $form = new \Garden\Form\CreateFeatureForm("Create Feature");
        $feature = new \Garden\Entity\Features();

        $form->setLabel("Nieuw Kenmerk");
        $form->get('submit')->setValue('Voeg toe');

        $form->bind($feature);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($feature);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/feature/index');
            }
        }

        return array(
            'form' => $form,
        );
    }


    public function editAction() {
        $form = new \Garden\Form\CreateFeatureForm("Edit Feature");
        $form->setLabel("Kenmerk aanpassen");
        $form->get('submit')->setValue('Pas aan');

        $id = $this->params('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $feature = $repository->find($id);

        $form->bind($feature);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getEntityManager()->persist($feature);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/feature/index');
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $feature = $repository->find($id);

        $this->getEntityManager()->remove($feature);
        $this->getEntityManager()->flush();

        return $this->redirect()->toUrl('/feature/index');
    }

}
