<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use yii\db\ActiveQuery;

final class CategoryQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;
}
