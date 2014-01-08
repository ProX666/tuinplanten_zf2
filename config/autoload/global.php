<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' => array(
				'params' => array(
					'charset'  => 'utf8',
					'driverOptions' => array(
						1002 => 'SET NAMES utf8'
					),
				),
			),
		),
		'configuration' => array(
			'orm_default' => array(
				'metadata_cache' => 'filesystem',
			),
		),
		'eventmanager' => array(
			'orm_default' => array(
				'subscribers' => array(
					'Gedmo\Tree\TreeListener',
					'Gedmo\Timestampable\TimestampableListener',
				),
			),
		),
	),

	'service_manager' => array(
		'factories' => array(
//			'Zend\Db\Adapter\Adapter'  =>  'Zend\Db\Adapter\AdapterServiceFactory',
			'Zend\Log' => function($sm) {
				$log = new \Zend\Log\Logger();
				$writer = new \Base\Util\DoctrineWriter($sm->get('doctrine.entitymanager.orm_default'));
				$log->addWriter($writer);
				return $log;
			},
		),
	),
	'module_layouts' => array(
		'Application' => 'application/layout/layout',
	),

	'zfctwig' => array(
		'disable_zf_model' => false,
		'environment_options' => array(
			'cache' => __DIR__ . '/../../data/twigcache',
		),
	),
	'application' => array(
		// application version
		'version' => '0.1',
		'date' => date('Y-m-d', filemtime(__FILE__)),
	),
);
