<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/12
 * Time: 16:05
 */

$config = [
    'id' => 'wechat',
    'basePath' => dirname(__DIR__),
    'language' => 'en', //默认语言
    'bootstrap' => ['log'],
    'modules' => [
        'wechat-api' => [
            'basePath' => '@app/modules/wechatApi',
            'class' => 'app\modules\wechatApi\Module',
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
                '<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<controller>/<action>',
                '<controller:[\w-]+><nouse:(.*)>' => '<controller>/index',
                '' => 'site/index'
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
        'ip' => [
            'class' => 'app\components\Ip',
        ],
        'wechat' => [
            'class' => 'app\components\Wechat',
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