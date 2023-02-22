<?php

namespace common\components\websocket;

use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

abstract class SocketCommand implements MessageComponentInterface
{
    abstract function onOpen(ConnectionInterface $conn);

    abstract function onClose(ConnectionInterface $conn);

    abstract function onError(ConnectionInterface $conn, \Exception $e);

    abstract function onMessage(ConnectionInterface $from, $msg);
}
