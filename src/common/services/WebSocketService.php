<?php

namespace common\services;

use common\components\websocket\SocketCommand;
use Ratchet\ConnectionInterface;

final class WebSocketService extends SocketCommand
{
    public function onOpen(ConnectionInterface $conn)
    {

    }

    public function onClose(ConnectionInterface $conn)
    {

    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {

    }

    public function onMessage(ConnectionInterface $from, $msg)
    {

    }
}
