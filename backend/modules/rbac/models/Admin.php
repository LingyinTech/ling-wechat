<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/10
 * Time: 21:47
 */

namespace backend\modules\rbac\models;


use backend\modules\rbac\base\ActiveRecord;
use yii\web\IdentityInterface;

class Admin extends ActiveRecord implements IdentityInterface
{

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}