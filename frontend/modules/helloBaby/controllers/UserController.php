<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 12:24
 */

namespace frontend\modules\helloBaby\controllers;

use common\modules\helloBaby\models\UserInfo;
use frontend\modules\helloBaby\base\Controller;
use Yii;

class UserController extends Controller
{
    public function actionLogin()
    {
        $code = Yii::$app->request->get('code');
        $result = Yii::$app->miniWechat->getInstance()->auth->session($code);
        if (empty($result['openid'])) {
            return $this->fail($result['errmsg']);
        }

        list($result['api_token'],$result['last_event_time']) = (new UserInfo())->checkLogin($result['openid']);

        return $this->format($result);
    }
}