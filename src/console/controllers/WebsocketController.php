<?php

namespace console\controllers;

use common\components\websocket\IoServer;
use yii\console\Controller;
use Yii;

final class WebsocketController extends Controller
{
    private IoServer $server;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->server = Yii::$app->websocket;
    }

    public function actionRun()
    {
        $this->server->run();
    }
}
