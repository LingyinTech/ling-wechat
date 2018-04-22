<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/3/15
 * Time: 22:58
 */

namespace backend\controllers;

use app\models\form\RegisterForm;
use backend\models\form\LoginForm;
use common\base\Controller;

class UserController extends Controller
{

    public function actionLogin()
    {
        \Yii::$app->cache->add('adb',333,60);
        var_dump(\Yii::$app->cache->get('adb'));

        return 111;

        if (!app()->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(app()->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $this->layout = '//main-login';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!app()->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(app()->request->post()) && $model->register()) {
            return $this->goBack();
        }

        $this->layout = '//main-login';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

}