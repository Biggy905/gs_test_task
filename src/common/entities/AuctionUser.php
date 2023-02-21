<?php

namespace common\entities;

use common\components\Model;
use common\helpers\DateTimeHelpers;
use yii\behaviors\TimestampBehavior;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
final class AuctionUser extends Model
{
    public static function tableName(): string
    {
        return 'auction_users';
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
}
