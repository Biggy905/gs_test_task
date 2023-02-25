<?php

namespace common\components\i18n;

final class PhpMessageSource extends \yii\i18n\PhpMessageSource
{
    use MessageSourceTrait;

    public string $fallbackLanguage;

    private $_messages = [];
    private $_fallback_messages = [];
}
