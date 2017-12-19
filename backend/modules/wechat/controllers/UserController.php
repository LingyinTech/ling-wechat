<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/18
 * Time: 22:27
 */

namespace app\modules\wechat\controllers;

use app\modules\wechat\base\Controller;

/**
 * 用户管理
 *
 * Class UserController
 * @package app\modules\wechat\controllers
 */
class UserController extends Controller
{

    public function actionList()
    {
        $list = $this->wechat->user->list();
        print_r($list);
    }

    public function actionInfo()
    {
        $info = $this->wechat->user->get('ox4bCt0wZR9itFdps3lbY4JmgAtE');
        print_r($info);
    }

}