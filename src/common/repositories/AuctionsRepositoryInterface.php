<?php

namespace common\repositories;

use common\entities\Auction;
use common\forms\BuyBetForm;

interface AuctionsRepositoryInterface
{
    public function findId(int $id): ?Auction;

    public function filter(array $filters): array;

    public function findAllQuery(array $filters): \yii\db\ActiveQuery;

    public function updateData(
        BuyBetForm $form,
        Auction $auction,
        int $id_user,
        string $user
    ): Auction;
}
