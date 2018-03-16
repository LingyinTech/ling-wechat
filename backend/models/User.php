<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/10
 * Time: 21:47
 */

namespace backend\models;


class User extends \mdm\admin\models\User
{

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

}