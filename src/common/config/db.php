<?php

return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=' . getenv('DB_HOSTNAME') .
        ';port=' . getenv('DB_PORT') .
        ';dbname=' . getenv('DB_DATABASE'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
    'on afterOpen' => static function (\yii\base\Event $event) {
        $event->sender->createCommand("SET GLOBAL time_zone = '+2:00'")->execute();
    },
    'attributes' => [
        PDO::ATTR_PERSISTENT => getenv('DB_PERSISTENT') ?? true,
    ],
];
