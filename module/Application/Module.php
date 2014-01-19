<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'my_image_service' => 'Imagine\Gd\Imagine',
            ),
        );
    }

    public function onDispatch(MvcEvent $e) {
        $result = $e->getResult();
        if ($result instanceof \Zend\View\Model\ViewModel) {
            $user = null;

            $service = new \Zend\Authentication\AuthenticationService();
            $identity = $service->getIdentity();
            if ($identity) {
                $user = $this->em->find('\Base\Entity\User', $identity['userId']);
            }

            // $result is the viewmodel of the action, $e->getViewModel is the viewmodel of the layout.
            $viewModel = $e->getViewModel();
            \Auth\Twig\TwigAuth::registerRights($result, 'Application\\Rights');
            \Auth\Twig\TwigAuth::registerRights($viewModel, 'Application\\Rights');

            $route = $e->getRouteMatch();
            $commonvars = array(
                'user' => $user,
                'route' => $route,
                'action' => $route->getParam('action', 'unknown'),
                'controller' => $route->getParam('__CONTROLLER__', 'unknown')
            );
            $result->setVariables($commonvars);
            $viewModel->setVariables($commonvars);
        }

        $sm = $e->getApplication()->getServiceManager();
        $twig = $sm->get('ZfcTwigEnvironment');
        $config = $sm->get('Config');
        $version = isset($config['application']['version']) ? $config['application']['version'] : 1.0;
        $date = isset($config['application']['date']) ? $config['application']['date'] : 'now';
        $twig->addGlobal('appversion', $version);
        $twig->addGlobal('releasedate', new \DateTime($date));
    }

}
