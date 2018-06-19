<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/25
 * Time: 1:32
 */

namespace backend\modules\orderFlow\models;


use backend\modules\orderFlow\base\ActiveRecord;

class Style extends ActiveRecord
{

    public static function getCache()
    {
        $list = (new self())->getList([]);

        $cacheData = [];
        foreach ($list as $item){
            $cacheData[$item['id']] = $item;
        }

        return $cacheData;
    }

}