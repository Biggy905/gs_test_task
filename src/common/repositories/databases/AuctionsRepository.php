<?php

namespace common\repositories\databases;

use common\entities\Auction;
use common\entities\AuctionUser;
use common\entities\Product;
use common\repositories\AuctionsRepositoryInterface;

final class AuctionsRepository implements AuctionsRepositoryInterface
{
    public function findId(string $id): ?Auction
    {
        return Auction::find()->byId($id)->one();
    }

    public function filter(array $filters): array
    {
        $query = $this->findAllQuery();

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

        return $query->all();
    }

    private function findAllQuery(): \yii\db\ActiveQuery
    {
        return Auction::find()
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
    }
}
