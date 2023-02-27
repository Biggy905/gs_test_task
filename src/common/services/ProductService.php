<?php

namespace common\services;

use common\groups\ProductGroup;
use common\groups\ProductListGroup;
use common\repositories\databases\ProductsRepository;
use DomainException;
use Yii;

final class ProductService
{
    public function __construct(
       public ProductsRepository $productsRepository
    ) {

    }

    public function findId(int $id): array
    {
        $auction = $this->productsRepository->findById($id);
        if (empty($auction)) {
            throw new DomainException(Yii::t('products', 'errors.not_found'));
        }

        return ProductGroup::toArray($auction);
    }

    public function findAll(array $filters): array
    {
        $products = $this->productsRepository->filter($filters);

        return ProductListGroup::toArray($products);
    }
}
