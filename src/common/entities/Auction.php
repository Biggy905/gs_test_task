<?php

namespace common\entities;

use common\components\db\SoftDeleteTrait;
use common\components\Model;
use common\helpers\DateTimeHelpers;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * @property string $id
 * @property string $id_product
 * @property string $id_user
 * @property string $name
 * @property string $status
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property AuctionUser $user
 * @property Product $product
 */
final class Auction extends Model
{
    use SoftDeleteTrait {
        SoftDeleteTrait::find as public findTrait;
    }

    public static function tableName(): string
    {
        return 'auctions';
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

    public function getProduct(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['id' => 'id_product']);
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasMany(AuctionUser::class, ['id' => 'id_user']);
    }
}
