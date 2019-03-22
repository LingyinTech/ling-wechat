<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/12
 * Time: 16:05
 */

$config = [
    'components' => [
        'urlManager' => [
            'class' => \common\components\UrlManager::class,
        ],
        'request' => [
            'cookieValidationKey' => '9nfRpkQ9RZYk8TzAVMsVeThqLePM9HdR',
        ],
    ],
];

if (is_file($file = __DIR__ . '/web.' . YII_ENV . '.php')) {
    $config = yii\helpers\ArrayHelper::merge($config, require($file));
}

return $config;