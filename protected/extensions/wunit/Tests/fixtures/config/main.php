<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => ['log'],
    // autoloading model and component classes
    'import' => [
        'application.models.*',
        'application.components.*',
    ],
    // application components
    'components' => [
        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ],
        // uncomment the following to enable URLs in path-format
        'urlManager' => [
            'urlFormat' => 'path',
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'assetManager' => [
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '../assets',
        ],
        //'db'=>array(
        //	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        //),
        // uncomment the following to use a MySQL database
        //		'db'=>array(
        //			'connectionString' => 'mysql:host=weavora-1;dbname=wfrom2',
        //			'emulatePrepare' => true,
        //			'username' => 'dev',
        //			'password' => 'dev',
        //			'charset' => 'utf8',
        //		),
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
                // uncomment the following to show log messages on web pages
                /*
                  array(
                  'class'=>'CWebLogRoute',
                  ),
                 */
            ],
        ],
    ],
    'params' => [
        'adminEmail' => 'webmaster@example.com',
    ],
];