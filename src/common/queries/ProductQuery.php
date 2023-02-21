<?php

namespace common\queries;

use common\entities\Product;
use yii\db\ActiveQuery;

final class ProductQuery extends ActiveQuery
{
    public function byId($id): self
    {
        return $this->andWhere([Product::tableName() . 'id' => $id]);
    }
}
