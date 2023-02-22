<?php

namespace console\fixtures;

use common\entities\Auction;
use yii\test\ActiveFixture;

final class AuctionsFixture extends ActiveFixture
{
    public $modelClass = Auction::class;
}
