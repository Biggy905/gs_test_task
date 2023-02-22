<?php

namespace common\components\db;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

trait SoftDeleteQueryTrait
{
    function withTrashed(): self
    {
        /** @var $this ActiveQuery */
        /** @var $model ActiveRecord */
        $model = $this->modelClass;

        $softDeleteKey = $model::tableName() . '.' . $model::$softDeleteAttribute;
        unset($this->where[$softDeleteKey]);

        return $this;
    }

    function onlyTrashed(): self
    {
        /** @var $this ActiveQuery */
        /** @var $model ActiveRecord */
        $model = $this->modelClass;

        $softDeleteKey = $model::tableName() . '.' . $model::$softDeleteAttribute;

        unset($this->where[$softDeleteKey]);

        return $this->andWhere(['IS NOT', $softDeleteKey, null]);
    }
}
