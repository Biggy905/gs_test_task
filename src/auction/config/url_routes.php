<?php

return [
    [
        'verb' => ['get'],
        'pattern' => 'auction/<id:\d+>',
        'route' => 'site/item'
    ],
    [
        'verb' => ['get'],
        'pattern' => '/',
        'route' => 'site/list'
    ],
    [
        'verb' => ['get', 'post'],
        'pattern' => '/registration',
        'route' => 'site/registration',
    ],
];
