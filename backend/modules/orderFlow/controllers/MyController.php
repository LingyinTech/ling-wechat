<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/6/22
 * Time: 1:20
 */

namespace backend\modules\orderFlow\controllers;


use backend\modules\orderFlow\models\OrderInfo;
use common\base\Controller;

class MyController extends Controller
{

    public function actionOrder()
    {
        $params['user_id'] = app()->getUser()->getId();

        $list = (new OrderInfo())->getList($params);

        return $this->render('order', [
            'list' => $list,
        ]);
    }

}