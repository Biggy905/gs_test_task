<?php

namespace console\fixtures;

use common\entities\Category;
use yii\test\ActiveFixture;

final class CategoriesFixture extends ActiveFixture
{
    public $modelClass = Category::class;
}
