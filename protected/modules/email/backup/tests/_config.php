<?php

/**
 * Global Test Config
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
return [
    'basePath' => BASE_PATH,
    'runtimePath' => realpath(BASE_PATH . '/_runtime'),
    'import' => [
        'email.components.*',
        'email.models.*',
        'booster.helpers.TbHtml',
    ],
    'aliases' => [
        'email' => realpath(BASE_PATH . '/../email'),
        'bootstrap' => realpath(BASE_PATH . '/../vendor/crisu83/yiistrap'),
        'swiftMailer' => realpath(BASE_PATH . '/../vendor/swiftmailer/swiftmailer/lib'),
    ],
    'controllerMap' => [
        'site' => 'application._components.SiteController',
    ],
    'components' => [
        'assetManager' => [
            'basePath' => realpath(BASE_PATH . '/_public/assets'),
        ],
        'bootstrap' => [
            'class' => 'booster.components.TbApi',
        ],
        'db' => [
            'connectionString' => 'sqlite:' . realpath(BASE_PATH . '/_runtime') . '/test.db',
        ],
        'emailManager' => [
            'class' => 'email.components.EmailManager',
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
        ],
    ],
    'modules' => [
        'email' => [
            'class' => 'email.EmailModule',
            'connectionID' => 'db',
            'controllerFilters' => [],
        ],
        'gii' => [
            'class' => 'system.gii.GiiModule',
            'generatorPaths' => [
                'vendor.cornernote.gii-modeldoc-generator',
                'booster.gii',
            ],
            'ipFilters' => ['127.0.0.1'],
            'password' => false,
        ],
    ],
];
