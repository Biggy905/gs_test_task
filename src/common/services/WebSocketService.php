<?php

namespace common\services;

use common\components\websocket\SocketCommand;
use Ratchet\ConnectionInterface;
use SplObjectStorage;
use yii\db\Exception;

final class WebSocketService extends SocketCommand
{
    public function __construct(
        private readonly AuctionService $auctionService,
        private readonly SplObjectStorage $spl,
    ) {
    }

    public function onOpen(ConnectionInterface $conn): void
    {
        $this->spl->attach($conn);
        $conn->send('Enable connection!');
    }

    public function onClose(ConnectionInterface $conn): void
    {
        $this->spl->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();

        throw new $e;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        foreach ($this->spl as $spl) {

            if ($from->resourceId === $spl->resourceId) {

            }

            $spl->send( "Client $from->resourceId said $msg" );
        }
    }
}
