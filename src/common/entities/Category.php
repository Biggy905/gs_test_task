<?php

namespace common\entities;

use common\components\db\SoftDeleteTrait;
use common\components\Model;
use common\helpers\DateTimeHelpers;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * @property string $id
 * @property string $id_category
 * @property string $name
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property Category[] $categories
 */
final class Category extends Model
{
    use SoftDeleteTrait {
        SoftDeleteTrait::find as public findTrait;
    }

    public static function tableName(): string
    {
        return 'categories';
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

    public function getCategories(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id_category' => 'id']);
    }
}
