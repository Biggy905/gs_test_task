<?php

namespace common\components\db;

use DateTime;
use yii\db\ActiveQuery;

trait SoftDeleteTrait
{
    public static bool $softDelete = true;

    public static string $softDeleteAttribute = 'deleted_at';

    public static function find(bool $withTrashed = false): ActiveQuery
    {
        $query = parent::find();

        if (!$withTrashed && static::$softDelete) {
            $query->andWhere([static::tableName() . '.' . static::$softDeleteAttribute => null]);
        }

        return $query;
    }

    public static function onlyTrashed(): ActiveQuery
    {
        return parent::find()->andWhere(
            [
                'not',
                [
                    static::tableName() . '.' . static::$softDeleteAttribute => null,
                ],
            ]
        );
    }

    public function softDelete(): void
    {
        $attribute = static::$softDeleteAttribute;

        $this->updateAttributes(
            [
                $attribute => (new DateTime())->format('Y-m-d H:i:s'),
            ]
        );
        $this->afterDelete();
    }

    public function restore(): void
    {
        $attribute = static::$softDeleteAttribute;

        $this->updateAttributes(
            [
                $attribute => null,
            ]
        );
    }

    public function getIsDeleted(): bool
    {
        $attribute = static::$softDeleteAttribute;

        return $this->$attribute !== null;
    }
}
