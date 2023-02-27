<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\Auction;
use yii\db\ActiveQuery;

/**
 * @method Auction|array|null one($db = null)
 * @method Auction[]|array all($db = null)
 * @method Auction[]|array each($batchSize = 100, $db = null)
 */
final class AuctionQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId(int $id): ActiveQuery
    {
        return $this->andWhere(
            [
                Auction::tableName() . '.id' => $id
            ]
        );
    }
}
