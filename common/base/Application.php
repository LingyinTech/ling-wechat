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
 * @property \yii\db\Connection $helloBabyDb The database connection. This property is read-only.
 * @property Ip $ip 获取用户IP的工具类
 * @property Wechat $wechat 微信组件
 * @property Wechat $miniWechat 微信小程序
 */
class Application extends \yii\web\Application
{

}