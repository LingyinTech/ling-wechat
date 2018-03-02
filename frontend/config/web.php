<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/12
 * Time: 16:05
 */

$config = [
    'id' => 'ling-wechat',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'wechat-api' => [
            'basePath' => '@frontend/modules/wechatApi',
            'class' => 'frontend\modules\wechatApi\Module',
        ],
        'hello-baby' => [
            'basePath' => '@frontend/modules/helloBaby',
            'class' => 'frontend\modules\helloBaby\Module',
        ],
        'digital-coin' => [
            'basePath' => '@frontend/modules/digitalCoin',
            'class' => 'frontend\modules\digitalCoin\Module',
        ],
    ],
    'components' => [
        'urlManager' => [
            'rules' => [
                '<module:(wechat-api|hello-baby|digital-coin)>/<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<module>/<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<controller>/<action>',
                '<controller:[\w-]+><nouse:(.*)>' => '<controller>/index',
                '' => 'site/index'
            ],
        ],
    ],
];

if (is_file($file = __DIR__ . '/web.' . YII_ENV . '.php')) {
    $config = yii\helpers\ArrayHelper::merge($config, require($file));
}

return $config;