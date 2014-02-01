<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Garden\Controller\BaseController;

class HabitatController extends BaseController
{

    protected $em;

    protected function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction()
    {
        // get all used habitats
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\PlantsHabitats');
        $habitatsWithPlants = $repository->findAll();

        $habitatsUsed = array();
        foreach ($habitatsWithPlants as $habitat)
        {
            if (!in_array($habitat->getHabitatId(), $habitatsUsed))
            {
                $habitatsUsed[] = $habitat->getHabitatId();
            }
        }

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitats = $repository->findAll();

        $this->result->setVariables(array(
            'habitats' => $habitats,
            'habitatsUsed' => $habitatsUsed
        ));

        return $this->result;
    }

    public function createAction()
    {
        $form = new \Garden\Form\CreateHabitatForm("Create Habitat");
        $habitat = new \Garden\Entity\Habitats();

        $form->setLabel("Nieuwe Groeiplaats");
        $form->get('submit')->setValue('Voeg toe');

        $form->bind($habitat);

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $this->getEntityManager()->persist($habitat);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/habitat/index');
            }
        }

        $this->result->setVariables(array(
            'form' => $form,
        ));

        return $this->result;
    }

    public function editAction()
    {
        $form = new \Garden\Form\CreateHabitatForm("Edit Habitat");
        $form->setLabel("Groeiplaats aanpassen");
        $form->get('submit')->setValue('Pas aan');

        $id = $this->params('id');

        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitat = $repository->find($id);

        $form->bind($habitat);

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $form->setData($request->getPost());
            if ($form->isValid())
            {
                $this->getEntityManager()->persist($habitat);
                $this->getEntityManager()->flush();
                return $this->redirect()->toUrl('/habitat/index');
            }
        }

        $this->result->setVariables(array(
            'form' => $form,
        ));

        return $this->result;
    }

    public function deleteAction()
    {
        $id = $this->params('id');
        $repository = $this->getEntityManager()->getRepository('Garden\Entity\Habitats');
        $habitat = $repository->find($id);

        $this->getEntityManager()->remove($habitat);
        $this->getEntityManager()->flush();

        return $this->redirect()->toUrl('/habitat/index');
    }

}
