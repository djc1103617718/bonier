<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=120.77.32.224;dbname=bonier',
            'username' => 'test',
            'password' => '123456',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'language' => 'zh-CN',
    'timeZone'=>'Asia/Chongqing',
];
