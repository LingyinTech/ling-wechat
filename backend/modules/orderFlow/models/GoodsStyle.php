<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/25
 * Time: 1:13
 */

namespace backend\modules\orderFlow\models;


use backend\modules\orderFlow\base\ActiveRecord;

class GoodsStyle extends ActiveRecord
{

    public function getStyleList($params = [])
    {
        $styleList = Style::getCache();

        $list = $this->getList($params);
        foreach ($list as &$item){
            $item['style_name'] = $styleList[$item['style_id']]['style_name'];
        }
        unset($item);

        return $list;
    }

}