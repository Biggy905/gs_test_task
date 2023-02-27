<?php

namespace common\repositories;

use common\entities\Product;

interface ProductsRepositoryInterface
{
    public function findById(int $id): ?Product;

    public function filter(array $filters): array;
}
