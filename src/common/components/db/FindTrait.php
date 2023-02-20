<?php

namespace common\components\db;

use yii\db\ActiveQuery;

trait FindTrait
{
    public static function find(): ActiveQuery
    {
        $query = parent::find();

        $query->andWhere([static::tableName() . '.deleted_at' => null]);

        return $query;
    }
}