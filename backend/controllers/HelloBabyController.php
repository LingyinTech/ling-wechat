<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/3/6
 * Time: 21:57
 */

namespace backend\controllers;


use common\base\Controller;

class HelloBabyController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}