<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/24
 * Time: 0:29
 */

namespace backend\modules\orderFlow\models;


use backend\modules\orderFlow\base\ActiveRecord;

/**
 * Class OrderGoods
 * @package backend\modules\orderFlow\models
 * @property int id 自增ID
 * @property string goods_remark 商品备注
 * @property int add_time 添加时间
 * @property int up_time 更新时间
 */
class OrderGoods extends ActiveRecord
{

    public function saveGoods($orderGoods)
    {
        if (empty($orderGoods['goods_id'])) {
            return false;
        }

        $params = [
            'order_id' => $orderGoods['order_id'],
            'goods_id' => $orderGoods['goods_id'],
            'goods_remark' => $orderGoods['goods_remark'],
        ];

        $sql = "DELETE FROM " . self::tableName() . " WHERE order_id = '{$orderGoods['order_id']}' AND goods_id = '{$orderGoods['goods_id']}'";
        self::getDb()->createCommand($sql)->execute();

        // 颜色
        list($colorType, $colorId, $colorValue) = explode('_', $orderGoods['color']);

        $attrList = (new GoodsAttr())->getList(['attr_type' => Attribute::SIZE_ATTR_ID]);
        $attrList = array_column($attrList, 'attr_value');
        unset($orderGoods['order_id'], $orderGoods['goods_id'], $orderGoods['goods_remark'], $orderGoods['color']);
        foreach ($orderGoods as $key => $num) {
            list($sizeType, $sizeId, $sizeValue) = explode('_', $key);

            // 尺码
            if (in_array($sizeValue, $attrList) && $num > 0) {

                $goodsInfo = $params;

                $goodsInfo['goods_attr_id'] = "{$colorType}_{$colorId},{$sizeType}_{$sizeId}";
                $goodsInfo['goods_attr_name'] = "{$colorType}_{$colorValue},{$sizeType}_{$sizeValue}";
                $goodsInfo['goods_num'] = $num;

                $this->isNewRecord = true;
                $this->setAttributes($goodsInfo, false);
                if (!$this->save()) {
                    return false;
                }
                unset($this->id);
            }
        }

        return true;
    }

    public function beforeSave($insert)
    {
        $nowTime = time();
        if ($insert) {
            $this->add_time = $nowTime;
            $this->up_time = $nowTime;
        } else {
            $this->up_time = $nowTime;
        }
        return parent::beforeSave($insert);
    }

}