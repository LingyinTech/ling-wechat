<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/3/2
 * Time: 22:35
 */

namespace frontend\controllers;


use common\base\Controller;

class ArticleController extends Controller
{

    function actionList()
    {

        return $this->render('list');
    }

}