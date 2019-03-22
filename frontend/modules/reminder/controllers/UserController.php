<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 12:24
 */

namespace frontend\modules\reminder\controllers;

use common\base\api\Controller;

class UserController extends Controller
{
    public function actionLogin()
    {
        $code = app()->request->get('code');
        $result = app()->reminder->getInstance()->auth->session($code);
        if (empty($result['openid'])) {
            return $this->fail($result['errmsg']);
        }

        return $this->format($result);
    }

    public function actionFormId()
    {
        $userId = app()->request->get('user_id');
        $formId = app()->request->get('form_id');

        return $this->success('success');
    }
}