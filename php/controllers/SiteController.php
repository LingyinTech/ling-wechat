<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/16
 * Time: 19:05
 */

namespace app\controllers;


use app\base\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return 'hello wechat.';
    }

}