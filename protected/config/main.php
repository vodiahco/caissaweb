<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'VineYard',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
            
            'application.components.settings.*',
            
            //as models
            'application.as.models.*',
            'application.as.models.behavior.event.*',
            'application.as.models.behavior.helpers.*',
            'application.as.models.behavior.log.*',
            'application.as.models.behavior.stat.*',
            //as components
            'application.as.components.*',
            'application.as.components.formhelpers.*',
            'application.as.components.settings.*',
            'application.as.components.viewhelpers.*',
            'application.as.components.webuserhelpers.*',
            'application.as.components.EUploadedImage12.*',
            'application.as.components.cleditor.*',
            //as controllers
            'application.as.controllers.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'online',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'mobile',
	),

	// application components
	'components'=>array(
		'user'=>array(
			'allowAutoLogin'=>true,
		),
		
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
//				'connectionString' => 'mysql:host=localhost;dbname=avineyard_serverx',
//			'emulatePrepare' => true,
			
				'connectionString' => 'mysql:host=localhost;dbname=avineyard_serverx',
			'emulatePrepare' => true,
			
                        'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
                         'tablePrefix' => 'vin_',
                    //                    
//                         'connectionString' => 'mysql:host=db494629406pmaster.db.1and1.com;dbname=db494629406pmaster',
//			'emulatePrepare' => true,
//                          'username' => 'dbo494629406pmaster',
//			'password' => '@global360xto',
//			'charset' => 'utf8',
//                         'tablePrefix' => 'vin_',
		),
            
            'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
            'adminName'=>'VineYard',
            'adminWeb'=>'http://www.vineyard.com',
	),
);