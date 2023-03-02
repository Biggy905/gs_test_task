<?php

namespace console\controllers;

use common\components\websocket\IoServer;
use yii\console\Controller;
use Yii;

final class WebsocketController extends Controller
{
    public function __construct(
        $id,
        $module,
        public readonly IoServer $server,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionRun()
    {
        $this->server->run();
    }
}
