<?php

namespace common\controllers;

use common\services\ProductService;
use yii\web\Controller;

final class ProductController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ProductService $productService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actionItem($id): string
    {
        return $this->render('@app/views/product/item');
    }

    public function actionList(): string
    {
        return $this->render('@app/views/product/list');
    }

    public function actionCreate(): string
    {
        return $this->render('@app/views/product/create');
    }

    public function actionUpdate(): string
    {
        return $this->render('@app/views/product/update');
    }

    public function actionDelete(): string
    {
        return $this->render('@app/views/product/delete');
    }
}