<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/17
 * Time: 20:33
 */

return [
    'bootstrap' => ['debug'],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['*']
        ]
    ],
    'components' => [
        'baseDb' => [
            'dsn' => 'mysql:host=local.test.mysql;dbname=db_lingyin_base',
            'username' => 'db_twinkle',
            'password' => 'Twinkle2017',
        ],
    ]
];