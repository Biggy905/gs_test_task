<?php

namespace common\repositories;

use common\entities\Auction;

interface AuctionsRepositoryInterface
{
    public function findId(string $id): ?Auction;

    public function filter(array $filters): array;
}
