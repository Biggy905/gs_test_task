<?php

return [
    'class' => \yii\redis\Connection::class,
    'retries' => 1,
    'socketClientFlags' => STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT,
];
