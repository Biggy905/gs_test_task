<?php

namespace common\entities;

use common\components\Model;
use yii\db\ActiveQuery;

final class Product extends Model
{
    public static function tableName(): string
    {
        return 'products';
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'id_category']);
    }
}
