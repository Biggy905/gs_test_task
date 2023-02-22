<?php

namespace common\components\websocket;

use Ratchet\Server\IoServer as RatchetServer;

final class IoServer
{
    public function __construct(
        public SocketCommand $command
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
