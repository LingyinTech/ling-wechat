<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/16
 * Time: 19:05
 */

namespace backend\controllers;

use backend\models\form\LoginForm;
use common\base\Controller;
use Yii;

class SiteController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $this->layout = '//main-login';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}