<?php

namespace common\groups;

use common\entities\Product;

final class ProductGroup
{
    public static function toArray(Product $product): array
    {
        return [
            'name' => $product->name,
            'category' => $product->category,
            'created_at' => $product->created_at,
        ];
    }
}
