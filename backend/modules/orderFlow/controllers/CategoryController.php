<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/6/30
 * Time: 11:22
 */

namespace backend\modules\orderFlow\controllers;


use common\base\Controller;

class CategoryController extends Controller
{

    public function actionIndex()
    {

        return $this->render('index');
    }

}