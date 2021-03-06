<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions = [
    'options' => ['class' => 'form-group has-feedback'],
];

$fieldEmail = [
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldUserName = [
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
];

$fieldPassword = [
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><?=Yii::t('Common', 'ProjectName');?></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><?=Yii::t('User', 'SignUp');?></p>

        <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

        <?= $form
            ->field($model, 'email', ArrayHelper::merge($fieldOptions,$fieldEmail))
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>

        <?= $form
            ->field($model, 'username', ArrayHelper::merge($fieldOptions,$fieldUserName))
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', ArrayHelper::merge($fieldOptions,$fieldPassword))
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <?= $form
            ->field($model, 'password_repeat', ArrayHelper::merge($fieldOptions,$fieldPassword))
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password_repeat')]) ?>

        <div class="row">
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('User', 'SignUp'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
        <?php /**
        <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
        using Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
        in using Google+</a>
        </div>
        <!-- /.social-auth-links -->
         */ ?>

        <a href="<?=Url::toRoute(['user/login'])?>" class="text-center"><?=Yii::t('User','Login');?></a>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
