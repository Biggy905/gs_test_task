<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\AuctionUser;
use yii\db\ActiveQuery;

/**
 * @method AuctionUser|array|null one($db = null)
 * @method AuctionUser[]|array all($db = null)
 * @method AuctionUser[]|array each($batchSize = 100, $db = null)
 */
final class AuctionUserQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId(int $id): ActiveQuery
    {
        return $this->andWhere(
            [
                AuctionUser::tableName() . '.id' => $id
            ]
        );
    }
}
