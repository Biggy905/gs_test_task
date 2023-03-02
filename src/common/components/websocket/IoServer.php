<?php

namespace common\components\websocket;

use common\services\WebSocketService;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer as RatchetServer;

final class IoServer
{
    public function __construct(
        public readonly WebSocketService $command
    ) {
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
