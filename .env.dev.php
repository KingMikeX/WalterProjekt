<?php

/**
 * This file is used in local docker-environment to create equivalent vcap-services like in cloud-environment
 * Basically generated with: composer dump-env dev and manually modified to add vcap-services
 */

$vcapArray = [
    'a9s-mysql101' => [0 =>
        ['credentials' =>
            ['uri' => 'mysql://user:password@db:3306/app']
        ]
    ],
    'a9s-redis50' => [0 =>
        ['credentials' =>
            [
                'host' => 'redis_master',
                'password' => 'secret',
                'port' => 6379,
            ]
        ]
    ],
];

$environment = [
    'APP_ENV' => 'dev',
    'APP_SECRET' => '84b318525ea6eb1ed4f9d5efa7a2353a',
    'APP_HOST' => 'localhost',
    'TRUSTED_PROXIES' => '127.0.0.1,172.18.0.0/24,89.202.107.0/24,4.159.0.0/16',
    'PHP_IDE_CONFIG' => 'serverName=sf5mike',
    'DATABASE_URL' => 'mysql://user:password@db:3306/app',
    'DATABASE_CHARSET' => 'utf8',
    'DATABASE_COLLATION' => 'utf8_general_ci',
    'MAILER_URL' => 'null://localhost',
    'VCAP_SERVICES' => \json_encode($vcapArray),
];

return $environment;
