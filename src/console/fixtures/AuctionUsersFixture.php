<?php

namespace console\fixtures;

use common\entities\AuctionUser;
use yii\test\ActiveFixture;

final class AuctionUsersFixture extends ActiveFixture
{
    public $modelClass = AuctionUser::class;
}
