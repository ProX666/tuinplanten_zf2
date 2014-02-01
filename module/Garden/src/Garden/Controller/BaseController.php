<?php

namespace Garden\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BaseController extends AbstractActionController
{

    protected $em;
    protected $config;
    protected $result;

    protected function getEntityManager()
    {
        if (null === $this->em)
        {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    protected function getConfig()
    {
        if (!isset($this->config))
        {
            $this->config = $this->getServiceLocator()->get('config');
        }

        return $this->config;
    }

    protected function getConfigItem($item)
    {
        $config = $this->getConfig();
        return $config[$item];
    }

    public function __construct()
    {
        $this->result = new ViewModel();
        $this->result->setTerminal(true);
    }

}