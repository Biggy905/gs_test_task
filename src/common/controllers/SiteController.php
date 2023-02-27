<?php

namespace common\controllers;

use common\forms\AuctionUserForm;
use common\forms\BuyBetForm;
use common\services\AuctionService;
use common\services\AuctionUserService;
use common\services\CookieService;
use common\services\SessionService;
use yii\web\Response;
use Yii;

final class SiteController extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/main';
    public $enableCsrfValidation = false;

    public function __construct(
        $id,
        $module,
        private readonly AuctionService $auctionService,
        private readonly AuctionUserService $auctionUserService,
        private readonly SessionService $sessionService,
        private readonly CookieService $cookieService,
        private readonly AuctionUserForm $auctionUserForm,
        private readonly BuyBetForm $buyBetForm,
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

    public function actionItem(int $id): string
    {
        $auction = $this->auctionService->findByid($id);

        if (
            $this->sessionService->hasSessionUserId()
            && $this->sessionService->hasSessionUserFullName()
        ) {
            $userId = $this->sessionService->getSessionUserId();
            $user = $this->sessionService->getSessionUserFullName();
            $this->auctionUserService->requestUser($userId, $user);
        }

        return $this->render(
            '@app/views/site/item',
            [
                'auction' => $auction,
                'session' => $this->sessionService,
                'cookie' => $this->cookieService,
            ]
        );
    }

    public function actionList(): string
    {
        $filters = $this->request->get();

        $auctions = $this->auctionService->findAll($filters);
        $pagination = $this->auctionService->pagination($filters);

        if (
            $this->sessionService->hasSessionUserId()
            && $this->sessionService->hasSessionUserFullName()
        ) {
            $userId = $this->sessionService->getSessionUserId();
            $user = $this->sessionService->getSessionUserFullName();
            $this->auctionUserService->requestUser($userId, $user);
        }

        return $this->render(
            '@app/views/site/index',
            [
                'auctions' => $auctions,
                'pagination' => $pagination,
                'session' => $this->sessionService,
                'cookie' => $this->cookieService,
            ]
        );
    }

    public function actionRegistration(): string|Response
    {
        if ($this->request->isPost) {
            $request = $this->request->post();

            $this->auctionUserForm->setAttributes($request);

            if (!empty($this->auctionUserForm->validate())) {
                $this->sessionService->session->addFlash('danger', 'Ошибка валидации!');

                return $this->render('@app/views/site/registration');
            }

            $user = $this->auctionUserService->create($this->auctionUserForm);
            $this->sessionService->setSessionUser($user->id, $user->getFullName());
            $this->cookieService->setCookie($user->getFullName());

            return $this->goHome();
        }

        return $this->render('@app/views/site/registration');
    }

    public function actionBuyBet(): Response
    {
        if(
            $this->request->isPost
            && $this->sessionService->hasSessionUserId()
            && $this->sessionService->hasSessionUserFullName()
        ) {
            $request = $this->request->post();

            $this->buyBetForm->setAttributes($request);
            if (!empty($this->buyBetForm->validate())) {
                $this->sessionService->session->addFlash('danger', 'Ошибка валидации!');

                return Yii::$app->response->redirect(['site/item', 'id' => $this->buyBetForm->id_auction]);
            }

            $auction = $this->auctionService->updateBuyBet(
                $this->buyBetForm,
                $this->sessionService->getSessionUserId(),
                $this->sessionService->getSessionUserFullName()
            );

            return Yii::$app->response->redirect(['site/item', 'id' => $auction->id]);
        }

        throw new \DomainException('Страница не найдена!');
    }
}
