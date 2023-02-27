<?php

namespace common\queries;

use common\components\db\SoftDeleteQueryTrait;
use common\entities\Category;
use yii\db\ActiveQuery;

/**
 * @method Category|array|null one($db = null)
 * @method Category[]|array all($db = null)
 * @method Category[]|array each($batchSize = 100, $db = null)
 */
final class CategoryQuery extends ActiveQuery
{
    use SoftDeleteQueryTrait;
}
