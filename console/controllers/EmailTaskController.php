<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/5
 * Time: 10:49
 */

namespace console\controllers;


use common\components\swoole\task\TaskClient;
use console\base\Controller;

class EmailTaskController extends Controller
{

    public function actionStart()
    {
        app()->emailTask->start();
    }

    public function actionStop()
    {
        app()->emailTask->stop();
    }

    public function actionRestart()
    {
        app()->emailTask->reStart();
    }

    public function actionTest(){
        (new TaskClient())->send('test php');
    }

}