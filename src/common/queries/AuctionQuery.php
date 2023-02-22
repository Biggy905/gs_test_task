<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\Auction;
use yii\db\ActiveQuery;

final class AuctionQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId(string $id): ActiveQuery
    {
        return $this->andWhere(
            [
                Auction::tableName() . '.id' => $id
            ]
        );
    }
}
