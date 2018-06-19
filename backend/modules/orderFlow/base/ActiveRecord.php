<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/18
 * Time: 0:22
 */

namespace backend\modules\orderFlow\base;


class ActiveRecord extends \backend\base\ActiveRecord
{

    public static function getDb()
    {
        return app()->orderFlowDb;
    }

}