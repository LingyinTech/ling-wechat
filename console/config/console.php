<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/12
 * Time: 16:05
 */

$config = [
    'id' => 'ling-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'modules' => [
    ],
    'components' => [
        'request' => [
        ],
        'urlManager' => [
            'rules' => [
                '<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<controller>/<action>',
                '<controller:[\w-]+><nouse:(.*)>' => '<controller>/index',
            ],
        ],
        'emailTask' => [
            'class' => 'common\components\swoole\task\TaskService',
            'psName' => 'email_task',
            'swooleConfig' => [
                'taskLogic' => 'console\task\EmailLogic',
                'task_worker_num' => 8,
            ]
        ],
        'wechatMessageTask' => [
            'class' => 'common\components\swoole\task\TaskService',
            'psName' => 'wechat_message_task',
        ]
    ],
];

if (is_file($file = __DIR__ . '/console.' . YII_ENV . '.php')) {
    $config = yii\helpers\ArrayHelper::merge($config, require($file));
}

return $config;