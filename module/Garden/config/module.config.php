<?php

namespace Garden;

return array(
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    ),
    // Add module specific routes.
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Garden\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    // Add invokable controllers.
    'controllers' => array(
        'invokables' => array(
            'Garden\Controller\Index' => 'Garden\Controller\IndexController'
        ),
    ),
    // The module has its own [view]. Add it to the config.
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
