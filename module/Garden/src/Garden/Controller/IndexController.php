<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    protected $em;

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

    public function indexAction() {
        $months = $months = $this->getConfigItem('months');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plants = $repository->findAll();

        return array(
            'months' => $months,
            'plants' => $plants,
        );
    }

    /**
     * Prepares data for ajax view call of features and habitats.
     * Disables layout for display in jQ popup window.
     *
     * @request id  : single id for one plant
     */
    public function getdataAction() {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $features = $plant->getFeatures();
        $habitats = $plant->getHabitats();

        $result = new ViewModel();
        $result->setTerminal(true);
        $result->setVariables(array(
            'id' => $id,
            'plant' => $plant,
            'features' => $features,
            'habitats' => $habitats
        ));
        return $result;
    }

}
