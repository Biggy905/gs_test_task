<?php

namespace common\services;

use common\components\websocket\SocketCommand;
use Ratchet\ConnectionInterface;
use yii\db\Exception;

final class WebSocketService extends SocketCommand
{
    private $client;

    public function __construct()
    {
        $this->client = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->client->attach($conn);
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->client->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();

        throw new $e;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo ("Работает!!!");
    }
}
