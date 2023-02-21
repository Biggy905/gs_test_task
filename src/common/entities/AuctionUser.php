<?php

namespace common\entities;

use common\components\Model;

final class AuctionUser extends Model
{
    public static function tableName()
    {
        return 'auction_users';
    }
}
