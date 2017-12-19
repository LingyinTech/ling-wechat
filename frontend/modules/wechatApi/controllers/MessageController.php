<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/16
 * Time: 19:47
 */

namespace frontend\modules\wechatApi\controllers;

use common\base\Controller;
use frontend\modules\wechatApi\handlers\MessageLogHandler;
use frontend\modules\wechatApi\handlers\MessageReplyHandler;
use Yii;

class MessageController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $wechat = Yii::$app->wechat->getInstance();
        $wechat->server->push(MessageLogHandler::class);
        $wechat->server->push(MessageReplyHandler::class);
        $response = $wechat->server->serve();
        $response->send();
    }

}