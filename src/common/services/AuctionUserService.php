<?php

namespace common\services;

use common\entities\AuctionUser;
use common\forms\AuctionUserForm;
use common\groups\AuctionUserGroup;
use common\repositories\databases\AuctionUsersRepository;
use DomainException;
use Yii;

final class AuctionUserService
{
    public function __construct(
        public AuctionUsersRepository   $repository,
        private readonly SessionService $sessionService,
        private readonly CookieService  $cookieService,
    )
    {

    }

    public function findById(int $id): array
    {
        $auctionUser = $this->repository->findById($id);

        if (empty($auction)) {
            throw new DomainException(Yii::t('auction_users', 'errors.not_found'));
        }

        return AuctionUserGroup::toArray($auctionUser);
    }

    public function create(AuctionUserForm $form): AuctionUser
    {
        $auctionUser = new AuctionUser();
        $auctionUser->first_name = $form->first_name;
        $auctionUser->last_name = $form->last_name;

        $this->repository->save($auctionUser);

        return $auctionUser;
    }

    public function requestUser(int $userId, string $user): null|array
    {
        if ($this->sessionService->session->isActive) {
            if ($this->sessionService->session->has('user')) {
                return [
                    'fullname' => $this->sessionService->getSessionUserFullName(),
                    'id_user' => $this->sessionService->getSessionUserId(),
                ];
            }

            $this->sessionService->setSessionUser($userId, $user);
            $this->cookieService->setCookie($user);
        }

        $this->sessionService->session->open();

        $this->requestUser($userId, $user);

        return [
            'fullname' => $this->sessionService->getSessionUserFullName(),
            'id_user' => $this->sessionService->getSessionUserId(),
        ];
    }
}
