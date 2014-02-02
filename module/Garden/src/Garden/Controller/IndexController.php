<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Controller\BaseController;

class IndexController extends BaseController
{

    public function indexAction()
    {
        $months = $months = $this->getConfigItem('months');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plants = $repository->findAll();

        $photos = array();
        $upload_repository = $this->getEntityManager()->getRepository('Garden\Entity\Uploads');
        foreach ($plants as $plant)
        {
            if ($photo = $upload_repository->findOneBy(array('selected' => true, 'plant' => $plant)))
            {
                $photos[$plant->getId()] = $photo->getFileName();
            } else
            {
                $photos[$plant->getId()] = "default";
            }
        }

         $this->result->setVariables(array(
            'months' => $months,
            'plants' => $plants,
            'photos' => $photos
        ));
        return $this->result;
    }

    /**
     * Prepares data for ajax view call of features and habitats.
     * Disables layout for display in jQ popup window.
     *
     * @request id  : single id for one plant
     */
    public function getdataAction()
    {

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Plants');
        $plant = $repository->find($id);

        $features = $plant->getFeatures();
        $habitats = $plant->getHabitats();

        $this->result->setVariables(array(
            'id' => $id,
            'plant' => $plant,
            'features' => $features,
            'habitats' => $habitats
        ));
        return $this->result;
    }

}
