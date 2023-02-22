<?php

namespace common\services;

use common\entities\Auction;
use common\groups\AuctionListGroup;
use common\repositories\databases\AuctionsRepository;
use DomainException;
use Yii;

final class AuctionService
{
    public function __construct(
        public AuctionsRepository $auctionsRepository
    ) {

    }

    public function findByid(string $id): Auction
    {
        $auction = $this->auctionsRepository->findId($id);

        if (empty($auction)) {
            throw new DomainException(Yii::t('auctions', 'errors.not_found'));
        }

        return $auction;
    }

    public function findAll(array $filters): array
    {
        $auctions = $this->auctionsRepository->filter($filters);

        return AuctionListGroup::toArray($auctions);
    }
}
