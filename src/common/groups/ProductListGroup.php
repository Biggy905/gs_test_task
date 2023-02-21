<?php

namespace common\groups;

final class ProductListGroup
{
    public static function toArray(array $products): array
    {
        $data = [];
        foreach ($products as $product) {
            $data[] = new ProductGroup($product);
        }

        return $data;
    }
}
