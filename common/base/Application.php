<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/19
 * Time: 20:53
 */

namespace common\base;

use common\components\Ip;
use common\components\Wechat;

/**
 * Class Application
 * @package app\base
 *
 * @property Ip $ip 获取用户IP的工具类
 * @property Wechat $wechat 微信组件
 */
class Application extends \yii\web\Application
{

}