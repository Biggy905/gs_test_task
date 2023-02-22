<?php

namespace common\groups;

use common\entities\AuctionUser;

final class AuctionUserGroup
{
    public static function toArray(AuctionUser $auctionUser): array
    {
        return [
            'id' => $auctionUser->id,
            'last_name' => $auctionUser->last_name,
            'first_name' => $auctionUser->first_name,
            'full_name' => $auctionUser->getFullName(),
        ];
    }
}
