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
            'dsn' => 'mysql:host=rds2n0dqneoagzjduq7zs.mysql.rds.aliyuncs.com;dbname=db_twinkle_ucenter',
            'username' => 'db_twinkle',
            'password' => 'Twinkle2017',
        ],
        'helloBabyDb' => [
            'dsn' => 'mysql:host=rds2n0dqneoagzjduq7zs.mysql.rds.aliyuncs.com;dbname=db_hello_baby',
            'username' => 'db_lingyin99',
            'password' => 'Lingyin99DB',
        ],
        'miniWechat' => [
            'type' => 'miniProgram',
            'appId' => 'wxe4f5e0a70d253f50',
            'secret' => '349c7650bf3550441db8be632ecabcf4',
        ]
    ]
];