<?php

namespace common\components\db;

use common\helpers\DateTimeHelpers;

trait DeleteTrait
{
    public function softDelete(): void
    {
        $this->updateAttributes(
            [
                'deleted_at' => DateTimeHelpers::createDateTime(),
            ]
        );
    }
}