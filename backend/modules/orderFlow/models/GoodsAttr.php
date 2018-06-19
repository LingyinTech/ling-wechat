<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/25
 * Time: 2:03
 */

namespace backend\modules\orderFlow\models;


use backend\modules\orderFlow\base\ActiveRecord;

class GoodsAttr extends ActiveRecord
{

    public function getAllAttr($params = [])
    {
        $attrList = [];

        if($list = $this->getList($params)){
            foreach ($list as $attr) {
                $attrList[$attr['attr_type']][] = $attr;
            }
        }
        return $attrList;
    }

}