<?php

namespace common\repositories\databases;

use common\entities\Auction;
use common\entities\AuctionUser;
use common\entities\Product;
use common\forms\BuyBetForm;
use common\helpers\DateTimeHelpers;
use common\repositories\AuctionsRepositoryInterface;

final class AuctionsRepository implements AuctionsRepositoryInterface
{
    public function findId(int $id): ?Auction
    {
        return Auction::find()->byId($id)->one();
    }

    public function filter(array $filters): array
    {
        $query = $this->findAllQuery($filters);

        return $query->all();
    }

    public function findAllQuery(array $filters): \yii\db\ActiveQuery
    {
        $query = Auction::find()
            ->join(
                'INNER JOIN',
                Product::tableName(),
                Product::tableName() . '.id = ' . Auction::tableName() . '.id_product'
            )
            ->join(
                'INNER JOIN',
                AuctionUser::tableName(),
                AuctionUser::tableName() . '.id = ' . Auction::tableName() . '.id_user'
            );


        $page = $filters['page'] ?? 1;
        $limit = $filters['limit'] ?? 10;

        if ($page < 1) {
            $page = 1;
        }

        if ($limit < 1 || $limit >= 25) {
            $limit = 10;
        }

        if ($page && $limit) {
            $query->limit($limit);
            $query->offset($page * $limit - $limit);
        }

        $sortFieldDirection = (string) ($filters['sort_direction'] ?? '');

        $sortDirection = match ($sortFieldDirection) {
            'asc' => 'SORT_ASC',
            default => 'SORT_DESC',
        };

        $query->orderBy(
            [
                'created_at' => $sortDirection
            ]
        );

        return $query;
    }

    public function updateData(
        BuyBetForm $form,
        Auction $auction,
        int $id_user,
        string $user
    ): Auction {
        $oldData = (array) $auction->data;
        $newData = [
            'bet' => $form->buy_bet,
            'id_user' => $id_user,
            'full_name' => $user,
            'created_at' => DateTimeHelpers::createDateTime(),
        ];

        $auction->data = array_merge($oldData, $newData);
        $auction->id_user = $id_user;
        $auction->updated_at = DateTimeHelpers::createDateTime();

        $auction->save();

        return $auction;
    }
}
