<?php

namespace common\services;

use yii\web\Cookie;
use yii\web\CookieCollection;

final class CookieService
{
    public function __construct(
        public readonly CookieCollection $cookieCollection,
    ) {

    }

    public function setCookie(string $name): void
    {
        $this->cookieCollection->add(
            new Cookie(
                [
                    'name' => 'user',
                    'value' => $name,
                ]
            )
        );
    }

    public function getCookie(): ?string
    {
        return $this->cookieCollection->get('user');
    }
}
