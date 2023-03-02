<?php

namespace common\entities;

use common\components\db\SoftDeleteTrait;
use common\components\Model;
use common\helpers\DateTimeHelpers;
use common\queries\AuctionQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * @property int $id
 * @property int $id_product
 * @property int $id_user
 * @property string $name
 * @property string $status
 * @property array $data
 * @property string $start_time
 * @property string $end_time
 * @property string $start_date
 * @property string $end_date
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

    public static function find(): AuctionQuery
    {
        return (new AuctionQuery(get_called_class()))->andWhere(self::findTrait()->where);
    }

    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'id_product'])
            ->join(
                'INNER JOIN',
                Category::tableName(),
                Category::tableName() . '.id =' . Product::tableName() . '.id_category'
            );
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(AuctionUser::class, ['id' => 'id_user']);
    }

    public function getTotal(): int
    {
        $data = $this->data ?? [];
        $bet = [];
        foreach ($data as $array) {
            if (!empty($array['bet'])) {
                $bet[] = $array['bet'];
            }
        }

        $total = array_sum($bet);

        return $total;
    }
}
