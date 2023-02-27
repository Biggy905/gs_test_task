<?php

namespace common\entities;

use common\components\db\SoftDeleteTrait;
use common\components\Model;
use common\helpers\DateTimeHelpers;
use common\queries\ProductQuery;
use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;

/**
 * @property int $id
 * @property int $id_category
 * @property string $name
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Category $category
 * @property Categories $categories[]
 */
final class Product extends Model
{
    use SoftDeleteTrait {
        SoftDeleteTrait::find as public findTrait;
    }

    public static function tableName(): string
    {
        return 'products';
    }

    public function behaviors(): array
    {
        return [
            'DefaultTimestampBehaviour' => [
                'class' => TimestampBehavior::class,
                'value' => DateTimeHelpers::createDateTime(),
            ],
        ];
    }

    public static function find(): ProductQuery
    {
        return (new ProductQuery(get_called_class()))->andWhere(self::findTrait()->where);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'id_category']);
    }
}
