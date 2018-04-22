<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/17
 * Time: 20:33
 */

return [
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=local.test.mysql;dbname=db_lingyin_wechat',
            'username' => 'db_twinkle',
            'password' => 'Twinkle2017',
        ],
        'helloBabyDb' => [
            'dsn' => 'mysql:host=local.test.mysql;dbname=db_hello_baby',
            'username' => 'db_twinkle',
            'password' => 'Twinkle2017',
        ],
        'digitalCoinDb' => [
            'dsn' => 'mysql:host=local.test.mysql;dbname=db_digital_coin',
            'username' => 'db_twinkle',
            'password' => 'Twinkle2017',
        ],
        'cache' => [
            'redis' => [
                'parameters' => [
                    [
                        'host' => 'local.test.redis',
                        'port' => 6380,
                    ],
                ],
                'options' => [
                    //'replication' => 'sentinel',
                    //'service' => $this->_options['master_name'],
                    'parameters' => [
                        'password' => 'profileLogStash',
                        'database' => 4,
                    ]
                ],
            ]
        ],
        'wechat' => [
            'appId' => 'wx2b8adaf93335685a',
            'secret' => 'ad9ef0b8cdc0cabcc7214b0f7b771fb4',
            'token' => 'lingyin99',
            'aesKey' => '',
        ],
        'miniWechat' => [
            'type' => 'miniProgram',
            'appId' => 'wxe4f5e0a70d253f50',
            'secret' => '349c7650bf3550441db8be632ecabcf4',
        ]
    ]
];