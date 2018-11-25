<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/5
 * Time: 21:32
 */

namespace console\base;


use common\components\swoole\task\TaskService;
use common\components\Wechat;

/**
 * Class Application
 * @package console\base
 *
 * @property TaskService $emailTask
 * @property TaskService $wechatMessageTask
 * @property Wechat $reminder 备忘录小程序
 *
 */
class Application extends \yii\console\Application
{

}