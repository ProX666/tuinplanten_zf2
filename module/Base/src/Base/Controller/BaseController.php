<?php

namespace Base\Controller;

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

    protected function getView()
	{
		if (!$this->view)
		{
			if ($this->params('format') == 'json' || $this->params()->fromQuery('json') !== null)
			{
				$this->view = new JsonModel();
			}
			else
			{
				$this->view = new ViewModel();
				if ($this->params('format') == 'tpl')
				{
					$this->view->setTerminal(true)->setVariable('format', 'tpl');
				}
			}
		}
		return $this->view;
	}

}