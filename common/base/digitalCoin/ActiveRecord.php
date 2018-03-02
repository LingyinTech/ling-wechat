<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 15:46
 */

namespace common\base\digitalCoin;

use Yii;

class ActiveRecord extends \common\base\ActiveRecord
{

    public static function getDb()
    {
        return Yii::$app->digitalCoinDb;
    }

}