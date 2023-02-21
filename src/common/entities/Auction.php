<?php

namespace common\entities;

use common\components\Model;
use yii\db\ActiveQuery;

final class Auction extends Model
{
    public static function tableName()
    {
        return 'auctions';
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
