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
    'controllerNamespace' => 'backend\controllers',
    'aliases' => [
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    'bootstrap' => ['admin'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
        'order-flow' =>[
            'basePath' => '@backend/modules/orderFlow',
            'class' => 'backend\modules\orderFlow\Module',
        ],
        'wechat' => [
            'basePath' => '@backend/modules/wechat',
            'class' => 'backend\modules\wechat\Module',
        ],
        'wechat-work' =>[
            'basePath' => '@backend/modules/wechatWork',
            'class' => 'backend\modules\wechatWork\Module',
        ]
    ],
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'user/login',
            'user/register',
            'site/error'
        ]
    ],
    'components' => [
        'baseDb' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'orderFlowDb' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'enableSchemaCache' => YII_ENV_PROD,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'user' => [
            'identityClass' => 'backend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['user/login']
        ],
        'authManager' => [
            'db' => 'baseDb',
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'assetManager' => [
            'basePath' => __DIR__ . '/../htdocs/assets',
            'assetMap' => [
                'jquery-ui.js' => '@web/static/js/jquery-ui-1.12.1/jquery-ui.js',
                'jquery-ui.min.js' => '@web/static/js/jquery-ui-1.12.1/jquery-ui.min.js',
            ],
        ],
        'urlManager' => [
            'rules' => [
                '<module:(order-flow)>/<controller:[\w-]+>/<action:[\w-]+>/state_<order_state:([\d])+><nouse:(.*)>' => '<module>/<controller>/<action>',
                '<module:(admin|order-flow|wechat|wechat-work)>/<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<module>/<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+><nouse:(.*)>' => '<controller>/<action>',
                '<controller:[\w-]+><nouse:(.*)>' => '<controller>/index',
            ],
        ],
    ],
    'params' => [
        'mdm.admin.configs' => [
            'db' => 'baseDb',
            'userDb' => 'baseDb',
        ]
    ]
];

if (is_file($file = __DIR__ . '/web.' . YII_ENV . '.php')) {
    $config = yii\helpers\ArrayHelper::merge($config, require($file));
}

return $config;