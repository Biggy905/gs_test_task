<?php

namespace common\services;

use common\entities\Auction;
use common\forms\BuyBetForm;
use common\groups\AuctionGroup;
use common\groups\AuctionListGroup;
use common\repositories\databases\AuctionsRepository;
use DomainException;
use Yii;
use yii\data\Pagination;

final class AuctionService
{
    public function __construct(
        public AuctionsRepository $auctionsRepository
    ) {

    }

    public function findByid(int $id): array
    {
        $auction = $this->auctionsRepository->findId($id);

        if (empty($auction)) {
            throw new DomainException(Yii::t('auctions', 'errors.not_found'));
        }

        return AuctionGroup::toArray($auction);
    }

    public function findAll(array $filters): array
    {
        $auctions = $this->auctionsRepository->filter($filters);

        return AuctionListGroup::toArray($auctions);
    }

    public function pagination(array $filters): Pagination
    {
        $auctions = $this->auctionsRepository->findAllQuery($filters);

        $limit = $filters['limit'] ?? 10;

        if ($limit < 1 || $limit >= 25) {
            $limit = 10;
        }

        $pagination = new Pagination(
            [
                'defaultPageSize' => 10,
                'pageSize' => $limit,
                'totalCount' => $auctions->count(),
                'pageSizeParam' => false,
                'forcePageParam' => false,
            ]
        );

        return $pagination;
    }

    public function updateBuyBet(
        BuyBetForm $form,
        int $userId,
        int $user
    ): Auction {
        $auction = $this->auctionsRepository->findId($form->id_auction);
        if (empty($auction)) {
            throw new DomainException(Yii::t('auctions', 'errors.not_found'));
        }

        $updateAuction = $this->auctionsRepository->updateData(
            $form,
            $auction,
            $userId,
            $user
        );

        return $updateAuction;
    }
}
