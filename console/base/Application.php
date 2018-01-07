<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/5
 * Time: 21:32
 */

namespace console\base;


use common\components\swoole\task\TaskService;

/**
 * Class Application
 * @package console\base
 *
 * @property TaskService $emailTask
 * @property TaskService $wechatMessageTask
 *
 */
class Application extends \yii\console\Application
{

}