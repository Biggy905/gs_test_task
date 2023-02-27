<?php

namespace common\forms;

use common\components\form\AbstractForm;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Number;
use Yiisoft\Validator\Rule\Required;

final class BuyBetForm extends AbstractForm
{
    public int $id_auction;
    public int $buy_bet;

    public function rules(): array
    {
        return [
            'id_auction' => [
                new Required(),
                new Number(min: 1, max: 20),
            ],
            'buy_bet' => [
                new Required(),
                new Number(min: 50, max: 50),
            ],
        ];
    }
}
