<?php

$routes = require __DIR__ . '/url_routes.php';

$config = [
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'common\controllers',
    'aliases' => [
        '@bower' => '@psr/bower-asset',
        '@npm'   => '@psr/npm-asset',
    ],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
        ],
        'request' => [
            'csrfParam' => '_csrf-users',
            'cookieValidationKey' => 'bcd8b1a4-1202-43b7-8bce-1aab868f28e1',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
    ],
];

$config['bootstrap'][] = 'debug';
$config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    'allowedIPs' => ['*', '::1'],
];

return $config;
