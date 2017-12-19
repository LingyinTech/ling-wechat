<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/17
 * Time: 21:17
 */

namespace frontend\modules\wechatApi\handlers;


use common\base\wechat\MessageHandler;

class MessageReplyHandler extends MessageHandler
{


    public function handle(array $payload = [])
    {
        return '您好！欢迎关注灵引未来!';
    }
}