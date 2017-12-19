<?php
/**
 * 入口文件
 */

defined('YII_ENV') || define('YII_ENV', empty($_SERVER['ENV']) ? 'prod' : $_SERVER['ENV']);
defined('YII_DEBUG') || define('YII_DEBUG', ('dev' == YII_ENV || (isset($_GET['debug']) && $_GET['debug'] == 1)));

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/web.php',
    require __DIR__ . '/../config/web.php'
);

Yii::$classMap['app\base\Application'] = __DIR__ . '/../base/Application.php';

(new \backend\base\Application($config))->run();
