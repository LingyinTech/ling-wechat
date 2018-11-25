<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/6/2
 * Time: 0:52
 */

namespace backend\modules\orderFlow\models;


use backend\modules\orderFlow\base\ActiveRecord;

class InvoiceType extends ActiveRecord
{

    public function getCache()
    {
        $data = app()->cache->get('invoice_type');
        if (empty($data)) {
            $list = $this->getList(['status' => 1], 'code,name');
            $data = [];
            foreach ($list as $item) {
                $data[$item['code']] = $item['name'];
            }
        }
        return $data;
    }

    public function deleteCache()
    {
        return app()->cache->delete('invoice_type');
    }
}