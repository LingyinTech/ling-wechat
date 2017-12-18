<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/17
 * Time: 21:09
 */

namespace app\modules\wechatApi\handlers;

use app\base\wechat\MessageHandler;
use app\models\WechatEvent;
use app\models\WechatInfo;

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