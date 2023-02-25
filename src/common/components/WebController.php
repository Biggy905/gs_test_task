<?php

namespace common\components;

use Yii;
use yii\base\View;

abstract class WebController extends \yii\web\Controller
{
    private $view;

    private $viewPath;

    public function setView($view): void
    {
        $this->view = $view;
    }

    public function getView(): View
    {
        if ($this->view === null) {
            $this->view = Yii::$app->getView();
        }

        return $this->view;
    }
}
