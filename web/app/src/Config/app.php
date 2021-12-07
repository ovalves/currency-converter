<?php

use Selene\Config\ConfigConstant;
use Selene\Database\DatabaseConstant;

return [
    ConfigConstant::DATABASE => [
        'mysql' => [
            DatabaseConstant::DB_HOST => env('MYSQL_HOST'),
            DatabaseConstant::DB_NAME => env('MYSQL_DATABASE'),
            DatabaseConstant::DB_USER => env('MYSQL_ROOT_USER'),
            DatabaseConstant::DB_PASS => env('MYSQL_ROOT_PASSWORD'),
        ],
        DatabaseConstant::DEFAULT_DB => 'mysql',
    ],
    ConfigConstant::AUTH => [
        ConfigConstant::AUTH_TABLE_NAME => 'users'
    ],
    ConfigConstant::SESSION => [
        ConfigConstant::SESSION_TABLE_NAME => 'session',
        ConfigConstant::SESSION_EXPIRATION_TIME => 3600,
        ConfigConstant::SESSION_REFRESH_TIME => 3600,
    ],
    ConfigConstant::ENABLE_SESSION_CONTAINER => true,
    ConfigConstant::ENABLE_AUTH_CONTAINER => true,
    ConfigConstant::ENABLE_CACHE_VIEWS => false,
];
