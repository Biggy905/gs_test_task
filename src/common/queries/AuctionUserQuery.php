<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\AuctionUser;
use yii\db\ActiveQuery;

final class AuctionUserQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId(string $id): ActiveQuery
    {
        return $this->andWhere(
            [
                AuctionUser::tableName() . '.id' => $id
            ]
        );
    }
}
