<?php

namespace common\entities;

use common\components\Model;

final class Category extends Model
{
    public static function tableName(): string
    {
        return 'categories';
    }
}
