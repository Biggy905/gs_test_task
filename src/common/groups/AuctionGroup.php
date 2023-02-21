<?php

namespace common\groups;

use common\entities\Auction;

final class AuctionGroup
{
    public static function toArray(Auction $auction): array
    {
        return [
            'name' => $auction->name,
            'product' => $auction->product->name,
            'category' => $auction->product->category->name,
            'full_name' => $auction->user->getFullName() ?? 'Not installed',
            'created_at' => $auction->created_at,
        ];
    }
}
