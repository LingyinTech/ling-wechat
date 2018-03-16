<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/4/23
 * Time: 15:08
 */

namespace backend\models;

use backend\base\ActiveRecord;
use Yii;

/**
 * Class UserInfo
 * @package app\models
 * @property int $user_id
 * @property string $email
 * @property string $user_name
 *
 */
class UserInfo extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_info';
    }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
        ];
    }

    public function getOne($user_id)
    {
        if (empty($_SESSION['user_info'])) {
            $_SESSION['user_info'] = (new static())->setWhere([
                'innerJoin' => ['user' => 'user_info.user_id = user.id'],
                'user_info.user_id' => $user_id,
                'select' => 'user_info.*,user.email,user.status'
            ])->asArray()->one();
        }
        return $_SESSION['user_info'];
    }
}