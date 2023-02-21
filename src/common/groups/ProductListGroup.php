<?php

namespace common\groups;

final class ProductListGroup
{
    public static function toArray(array $products): array
    {
        $data = [];
        foreach ($products as $product) {
            $data[] = ProductGroup::toArray($product);
        }

        return $data;
    }
}
