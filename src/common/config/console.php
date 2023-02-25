<?php

$db = require __DIR__ . '/db.php';
$params = require __DIR__ . '/params.php';
$container = require __DIR__ . '/containers.php';

$config = [
    'id' => 'base-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'bootstrap' => [
        'log',
        'queue',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationTable' => 'migrations',
            'migrationPath' => null,
            'migrationNamespaces' => [
                'console\migrations',
            ],
        ],
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'console\fixtures',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'common\components\RbacManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => \yii\redis\Connection::class,
            'retries' => 1,
            'socketClientFlags' => STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'commandClass' => \common\components\queue\QueueCommand::class,
            'redis' => 'redis',
            'channel' => 'main',
        ],
        'db' => $db,
        'websocket' => static function() {
            $service = new \common\services\WebSocketService();

            return new \common\components\websocket\IoServer($service);
        }
    ],
    'container' => [
        'singletons' => $container,
        'definitions' => [],
    ],
    'params' => $params,
];

return $config;
