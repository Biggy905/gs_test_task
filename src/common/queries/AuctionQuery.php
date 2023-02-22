<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use yii\db\ActiveQuery;

final class AuctionQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;
}
