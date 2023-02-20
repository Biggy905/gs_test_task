<?php

namespace common\components;

use common\enums\TimeZoneEnums;
use common\helpers\DateTimeHelpers;
use yii\db\ActiveRecord;

abstract class Model extends ActiveRecord
{
    public function softDelete()
    {
        $this->updateAttributes(
            [
                'deleted_at' => DateTimeHelpers::createDateTime(null, TimeZoneEnums::TIMEZONE_UTC),
            ]
        );

        $this->afterDelete();
    }
}
