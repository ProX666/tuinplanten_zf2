<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Controller\BaseController;
use Zend\View\Model\JsonModel;

class FeatureController extends BaseController
{

    public function listAction()
    {
        // get all used features
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\PlantsFeatures');
        $featuresWithPlants = $repository->findAll();

        $featuresUsed = array();
        foreach ($featuresWithPlants as $feature)
        {
            if (!in_array($feature->getFeatureId(), $featuresUsed))
            {
                $featuresUsed[] = $feature->getFeatureId();
            }
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $result = $repository->findAll();

        $features = array();
        foreach ($result as $feature)
        {
            $features[] = array(
                'id' => $feature->getId(),
                'name' => $feature->getFeature(),
                'delete' => !in_array($feature->getId(), $featuresUsed)
            );
        }

        return new JsonModel($features);
    }

    public function createAction()
    {
        $form = new \Garden\Form\CreateFeatureForm("CreateFeature");
        $feature = new \Garden\Entity\Features();

        $form->bind($feature);

        if (file_get_contents("php://input"))
        {
            $data = json_decode(file_get_contents("php://input"));
            $feature->setFeature($data->name);
            $this->getEntityManager()->persist($feature);
            $this->getEntityManager()->flush();
            echo "success";
            die;
        } else
        {
            $this->result->setVariables(array(
                'form' => $form,
            ));

            return $this->result;
        }
    }

    public function updateAction()
    {
        if (file_get_contents("php://input"))
        {
            $data = json_decode(file_get_contents("php://input"));
            $id = $data->id;
            $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
            $feature = $repository->find($id);

            $feature->setFeature($data->name);
            $this->getEntityManager()->persist($feature);
            $this->getEntityManager()->flush();
            echo "success";
            die;
        } else
        {
            echo "error";
            die;
        }
        die;
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Features');
        $feature = $repository->find($id);

        $this->getEntityManager()->remove($feature);
        $this->getEntityManager()->flush();
        die;
    }

}
