<?php

namespace common\groups;

final class AuctionListGroup
{
    public static function toArray(array $auctions): array
    {
        $data = [];

        foreach ($auctions as $auction) {
            $data[] = AuctionGroup::toArray($auction);
        }

        return $data;
    }
}
