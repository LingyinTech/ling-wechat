<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/17
 * Time: 21:11
 */

namespace common\base\wechat;

use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

abstract class MessageHandler implements EventHandlerInterface
{
    abstract public function handle(array $payload = []);

}