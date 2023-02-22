<?php

namespace common\repositories\databases;

use common\entities\Product;
use common\queries\CategoryQuery;
use common\repositories\ProductsRepositoryInterface;

final class ProductsRepository implements ProductsRepositoryInterface
{
    public function filter(array $filters): array
    {
        $query = $this->findAllQuery();

        $page = $filters['page'] ?? 1;
        $limit = $filters['limit'] ?? 25;

        if ($page < 1) {
            $page = 1;
        }

        if ($limit < 1 || $limit >= 50) {
            $limit = 25;
        }

        if ($page && $limit) {
            $query->limit($limit);
            $query->offset($page * $limit - $limit);
        }

        $sortFieldDirection = (string) ($filters['sort_direction'] ?? '');
        $sortDirection = match ($sortFieldDirection) {
            'asc' => SORT_ASC,
            default => SORT_DESC,
        };

        $query->groupBy(['created_at' => $sortDirection]);

        return $query->all();
    }

    private function findAllQuery(): \yii\db\ActiveQuery
    {
        return Product::find()
            ->with(
                [
                    'category' => static function (CategoryQuery $query) {
                        $query->withTrashed();
                    },
                ]
            );
    }
}
