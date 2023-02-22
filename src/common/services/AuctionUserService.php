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
        public AuctionUsersRepository $repository
    ) {

    }

    public function findById(string $id): array
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
}
