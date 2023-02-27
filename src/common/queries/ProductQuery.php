<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\Product;
use yii\db\ActiveQuery;

/**
 * @method Product|array|null one($db = null)
 * @method Product[]|array all($db = null)
 * @method Product[]|array each($batchSize = 100, $db = null)
 */
final class ProductQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId($id): self
    {
        return $this->andWhere([Product::tableName() . 'id' => $id]);
    }
}
