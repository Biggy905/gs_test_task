<?php

namespace common\groups;

use yii\data\Pagination;

final class AuctionPaginationGroup
{
    public static function toArray(Pagination $pagination): array
    {
        return [
            'page' => $pagination->page,
            'count' => $pagination->pageCount,
        ];
    }
}
