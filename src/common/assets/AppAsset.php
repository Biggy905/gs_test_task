<?php

namespace common\assets;

use yii\web\AssetBundle;

final class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
