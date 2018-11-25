<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/3/6
 * Time: 20:53
 */

namespace console\controllers;


use console\base\Controller;

class WechatMessageController extends Controller
{
    public function actionTest() {
        $instance = app()->reminder->getInstance();
        $result = $instance->template_message->send([
            'touser' => 'ofaT54nBnSCqrdWvA3mzuZUOQycg',
            'template_id' => 'szzNDTmGAwjYGOeWBUcWFDCDRGHVm_ntla8zGAcdk_0',
            'page' => 'pages/index',
            'form_id' => '1543170855628',
            'data' => [
                'keyword1' => '宝宝出生42天',
                'keyword2' => '要打育苗了',
            ],
        ]);
        var_dump($result);
    }
}