<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\Product;
use yii\db\ActiveQuery;

final class ProductQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;

    public function byId($id): self
    {
        return $this->andWhere([Product::tableName() . 'id' => $id]);
    }
}
