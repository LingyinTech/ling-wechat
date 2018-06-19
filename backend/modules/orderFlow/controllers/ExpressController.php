<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/4/25
 * Time: 23:14
 */

namespace backend\modules\orderFlow\controllers;


use common\base\Controller;

class ExpressController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}