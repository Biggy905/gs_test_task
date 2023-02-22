<?php

namespace common\groups;

use common\entities\Auction;

final class AuctionGroup
{
    public static function toArray(Auction $auction): array
    {
        return [
            'id' => $auction->id,
            'name' => $auction->name,
            'product' => $auction->product->name,
            'category' => $auction->product->category->name,
            'start_time' => $auction->start_time,
            'end_time' => $auction->end_time,
            'start_date' => $auction->start_date,
            'end_date' => $auction->end_date,
            'full_name' => $auction->user->getFullName() ?? 'Not installed',
            'created_at' => $auction->created_at,
        ];
    }
}
