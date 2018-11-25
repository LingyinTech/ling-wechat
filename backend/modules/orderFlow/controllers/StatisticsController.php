<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/6/30
 * Time: 10:11
 */

namespace backend\modules\orderFlow\controllers;


use common\base\Controller;

class StatisticsController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSale()
    {
        return $this->render('sale');
    }

}