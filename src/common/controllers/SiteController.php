<?php

namespace common\controllers;

use common\services\AuctionService;
use common\services\AuctionUserService;
use Yii;

final class SiteController extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';

    public function __construct(
        $id,
        $module,
        private readonly AuctionService $auctionService,
        private readonly AuctionUserService $auctionUserService,
        array $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $filters = $this->request->getBodyParams();

        $auctions = $this->auctionService->findAll($filters);

        return $this->render(
            '@app/views/site/index',
            [
                'auctions' => $auctions,
            ]
        );
    }
}
