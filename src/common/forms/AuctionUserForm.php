<?php

namespace common\forms;

use common\components\form\AbstractForm;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Required;

final class AuctionUserForm extends AbstractForm
{
    public string $first_name;
    public string $last_name;

    public function rules(): array
    {
        return [
            'first_name' => [
                new Required(),
                new Length(min: 1, max: 20),
            ],
            'last_name' => [
                new Required(),
                new Length(min: 1, max: 20),
            ],
        ];
    }
}
