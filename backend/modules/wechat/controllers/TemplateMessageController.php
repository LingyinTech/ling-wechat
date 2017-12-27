<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/18
 * Time: 22:15
 */

namespace backend\modules\wechat\controllers;

use backend\modules\wechat\base\Controller;

/**
 * 模板消息
 *
 * Class TemplateMessageController
 * @package app\modules\wechat\controllers
 */
class TemplateMessageController extends Controller
{

    public function actionList()
    {
        $list = $this->wechat->template_message->getPrivateTemplates();
        print_r($list);
    }

    public function actionSend()
    {
        $result = $this->wechat->template_message->send([
            'touser' => 'ox4bCt0wZR9itFdps3lbY4JmgAtE',
            'template_id' => '0deSUEgWQLJ8egIuPPv3gRvXNXXBp1Ky8QQMOXlN9W0',
            'url' => 'http://wechat.lingyin99.com',
            'data' => [
                'amount' => '100.00'
            ],
        ]);
        var_dump($result);
    }
}