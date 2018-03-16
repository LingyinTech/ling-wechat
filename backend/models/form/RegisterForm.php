<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/4/23
 * Time: 14:50
 */

namespace app\models\form;


use backend\models\UserInfo;
use backend\models\User;
use Yii;
use yii\base\Model;


class RegisterForm extends Model
{

    public $email;
    public $username;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            [['email', 'username', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 64],
            ['email', 'unique', 'targetClass' => 'backend\models\User', 'message' => Yii::t('User','EmailUsed')],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>Yii::t('User','PasswordsNotMatch')],
            ['username', 'string', 'max' => 32],
            ['username', 'unique', 'targetClass' => 'backend\models\User', 'message' => Yii::t('User','UsernameUsed')],
        ];
    }

    /**
     * 注册
     *
     * @return User|null
     */
    public function register()
    {
        if ($this->validate()) {
            $user = new User();
            $userInfo = new UserInfo();
            $user->email = $this->email;
            $user->username = $this->username;
            $user->setPassword($this->password);
            $trans = Yii::$app->db->beginTransaction();
            if ($user->save()) {
                $userInfo->user_id = $user->getId();
                if($userInfo->save()){
                    $trans->commit();
                    return $user;
                }
            }
            $trans->rollBack();
        }
        return null;
    }

}