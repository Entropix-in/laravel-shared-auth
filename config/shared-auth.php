<?php 

return [
    'connections' => [
        'mysql_users' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_USERS',env('DB_HOST', '127.0.0.1')),
            'port' => env('DB_PORT_USERS', env('DB_PORT', '3306')),
            'database' => env('DB_DATABASE_USERS', env('DB_DATABASE', 'laravel')),
            'username' => env('DB_USERNAME_USERS', env('DB_USERNAME', 'root')),
            'password' => env('DB_PASSWORD_USERS', env('DB_PASSWORD', '')),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ],
];
