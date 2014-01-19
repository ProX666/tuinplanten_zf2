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

            'garden' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/[:controller[/[:action[/[:id]]]]]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__ . '\Controller',
                        'controller' => 'Garden\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'details' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/details[/:action][/:id]',
                    'constraints' => array(
                        '__NAMESPACE__' => __NAMESPACE__,
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__,
                        'controller' => 'Garden\Controller\Index',
                        'action' => 'getdata',
                    ),
                ),
            ),
            'thumb' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thumb[/:id]',
                    'constraints' => array(
                        '__NAMESPACE__' => __NAMESPACE__,
                        'id' => '[0-9]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => __NAMESPACE__,
                        'controller' => 'Garden\Controller\Photo',
                        'action' => 'thumb',
                    ),
                ),
            ),
        ),
    ),
    // Add invokable controllers.
    'controllers' => array(
        'invokables' => array(
            'Garden\Controller\Index' => 'Garden\Controller\IndexController',
            'Garden\Controller\Plant' => 'Garden\Controller\PlantController',
            'Garden\Controller\Feature' => 'Garden\Controller\FeatureController',
            'Garden\Controller\Habitat' => 'Garden\Controller\HabitatController',
            'Garden\Controller\Photo' => 'Garden\Controller\PhotoController',
        ),
    ),
    // The module has its own [view]. Add it to the config.
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
