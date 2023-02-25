<?php

namespace common\components\websocket;

use common\services\WebSocketService;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer as RatchetServer;

final class IoServer
{
    public function __construct(
        public MessageComponentInterface $command
    ) {
        $this->command = new WebSocketService();
    }

    public function run(): void
    {
        $server = RatchetServer::factory(
            $this->command,
            3300
        );

        $server->run();
    }
}
