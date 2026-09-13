<?php

return [
    'install' => [
        'path' => '/install',
        'middleware' => [],
    ],
    'admin' => [
        'prefix' => 'admin',
        'middleware' => ['auth', 'admin_only'],
    ],
    'api' => [
        'prefix' => 'api',
        'middleware' => ['api'],
    ],
    'customer' => [
        'prefix' => 'customer',
        'middleware' => ['auth', 'customer'],
    ],
];
