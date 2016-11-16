<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'username',
                    'password' => 'password',
                    'dbname' => 'database',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ],
        'driver' => [
            'App_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/App/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'App\Entity' => 'App_driver'
                ]
            ]
        ]
    ]
];