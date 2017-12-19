<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/17
 * Time: 21:09
 */

namespace frontend\modules\wechatApi\handlers;

use common\base\wechat\MessageHandler;
use common\models\WechatEvent;
use common\models\WechatInfo;

class MessageLogHandler extends MessageHandler
{
    public function handle(array $message = [])
    {
        switch ($message['MsgType']) {
            case 'event':
                (new WechatEvent())->saveData($message, true);
                break;
            default:
                (new WechatInfo())->saveData($message, true);
        }
        return true;
    }

}