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
            'appId' => 'xxxx',
            'secret' => 'xxxx',
            'token' => 'xxxx',
            'aesKey' => '',
        ],
        'miniWechat' => [
            'type' => 'miniProgram',
            'appId' => 'xxx',
            'secret' => 'xxx',
        ],
        'imageUpload' => [
            'serviceName' => 'image-lingyin99',
            'operatorName' => 'actors315',
            'operatorPwd' => 'Lingyin99',
            'apiKey' => 'NfO/8EZtfT/WxK8iTLr2QYNjxpY=',
            'preFixPath' => 'lingyin-wechat',
            'baseUrl' => 'https://image-lingyin99.test.upcdn.net'
        ]
    ]
];