<?php

namespace common\repositories\databases;

use common\entities\AuctionUser;
use common\repositories\AuctionUsersRepositoryInterface;
use LogicException;
use Yii;

final class AuctionUsersRepository implements AuctionUsersRepositoryInterface
{
    public function findById(string $id): ?AuctionUser
    {
        return AuctionUser::find()->byId($id)->one();
    }

    public function save(AuctionUser $user)
    {
        if (!$user->save())
        {
            throw new LogicException(Yii::t('auction_users', 'errors.not_save'));
        }

        return $user;
    }
}
