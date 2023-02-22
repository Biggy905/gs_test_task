<?php

namespace common\controllers;

use common\forms\AuctionUserForm;
use common\services\AuctionService;
use common\services\AuctionUserService;
use yii\web\Controller;
use Yii;

final class TestController extends Controller
{
    public function __construct(
        $id,
        $module,
        public AuctionUserForm $auctionUserForm,
        public AuctionUserService $auctionUserService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);

    }

    public function actionTest(): string
    {
        $request = Yii::$app->request->getBodyParams();

        $this->auctionUserForm->setAttributes($request);
        $validate = $this->auctionUserForm->validate();
        if (!empty($validate)) {
            // Здесь из $validate достаем ошибки и передаем куда хотим, например views или throw
        }

        $auctionUser = $this->auctionUserService->create($this->auctionUserForm);

        return $this->render('index', compact('auctionUser'));
    }
}
