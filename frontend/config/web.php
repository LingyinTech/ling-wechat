<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/12
 * Time: 16:05
 */

$config = [
    'id' => 'admin',
    'basePath' => dirname(__DIR__),
    'language' => 'en', //默认语言
    'bootstrap' => ['log'],
    'modules' => [
        'wechat-api' => [
            'basePath' => '@frontend/modules/wechatApi',
            'class' => 'frontend\modules\wechatApi\Module',
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => '9nfRpkQ9RZYk8TzAVMsVeThqLePM9HdR',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                '<module:(wechat|wechat-api|wechat-work)>/<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<module>/<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<controller>/<action>',
                '<controller:[\w-]+><nouse:(.*)>' => '<controller>/index',
                '' => 'site/index'
            ],
        ]
    ],
    'params' => [
        'passToken' => 'dda0cf5854f6b403123b27775531ee89'
    ]
];

if (is_file($file = __DIR__ . '/web.' . YII_ENV . '.php')) {
    $config = yii\helpers\ArrayHelper::merge($config, require($file));
}

return $config;