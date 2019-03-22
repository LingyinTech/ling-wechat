<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 15:46
 */

namespace common\modules\reminder;

use common\helpers\Str;
use Yii;

class ActiveRecord extends \common\base\ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->db;
    }

    public static function tableName()
    {
        return 'reminder_' . Str::revertUcWords(
            substr(strrchr(get_called_class(), '\\'), 1),
            '_'
        );
    }

}