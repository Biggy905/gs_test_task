<?php

namespace console\fixtures;

use common\entities\Product;
use yii\test\ActiveFixture;

final class ProductsFixture extends ActiveFixture
{
    public $modelClass = Product::class;
}
