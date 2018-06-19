<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/21
 * Time: 0:37
 */

namespace backend\modules\orderFlow\models\form;


use backend\models\User;
use backend\modules\orderFlow\models\Attribute;
use backend\modules\orderFlow\models\Goods;
use backend\modules\orderFlow\models\GoodsAttr;
use backend\modules\orderFlow\models\OrderGoods;
use backend\modules\orderFlow\models\OrderInfo;
use common\base\Model;

class OrderInfoForm extends Model
{

    protected $attributesArr = [];

    public $real_name;
    public $order_time = '';
    public $plan_time = '';
    public $barCode = '';

    public $skuList = [];

    public function init()
    {
        parent::init();
    }

    /**
     * 设置值
     *
     * @param null | OrderInfo $orderInfo
     * @return mixed
     */
    public function loadData($orderInfo = null)
    {
        if ($orderInfo instanceof OrderInfo) {
            if (empty($orderInfo->user_id)) {
                $this->real_name = app()->getUser()->getIdentity(false)->getUsername();
            } else {
                $userInfo = User::findOne($orderInfo->user_id);
                $this->real_name = $userInfo->getUsername();
            }
            $nowTime = time();
            $orderTime = $orderInfo->order_time ?: $nowTime;
            $this->order_time = date('Y-m-d H:i:s', $orderTime);

            $planTime = $orderInfo->plan_time ?: $nowTime;
            $this->plan_time = date('Y-m-d H:i:s', $planTime);

            if (empty($orderInfo->id)) {
                return $this;
            }

            $this->barCode = app()->barCode->getPNG($orderInfo->order_sn);

            // 填充sku
            $orderGoodsArr = (new OrderGoods())->getList(['order_id' => $orderInfo->id]);
            $orderGoodsList = [];
            $orderGoodsRemark = [];
            foreach ($orderGoodsArr as $goods) {
                list($color, $size) = explode(',', $goods['goods_attr_id']);
                $orderGoodsList[$goods['goods_id']][$color][$size] = $goods['goods_num'];
                $orderGoodsRemark[$goods['goods_id']] = $goods['goods_remark'];
            }

            $goodsIdArr = array_keys($orderGoodsList);

            $goodsInfoArr = (new Goods())->getList(['in' => ['id' => $goodsIdArr]]);
            $goodsInfoList = [];
            foreach ($goodsInfoArr as $goods) {
                $goodsInfoList[$goods['id']] = $goods;
            }


            $goodsAttrArr = (new GoodsAttr())->getList(['in' => ['goods_id' => $goodsIdArr]]);
            $goodsAttrList = [];
            foreach ($goodsAttrArr as $attr) {
                $goodsAttrList[$attr['goods_id']][$attr['attr_type']][] = $attr;
            }

            $skuList = [];
            foreach ($orderGoodsList as $goodsId => $colorList) {
                foreach ($colorList as $sizeList) {
                    $goods['goods_id'] = $goodsId;
                    $goods['name'] = $goodsInfoList[$goodsId]['name'];
                    $goods['goods_remark'] = $orderGoodsRemark[$goodsId];
                    $goods['color_list'] = $goodsAttrList[$goodsId][Attribute::COLOR_ATTR_ID];
                    $goods['color'] = '';
                    $goods['size_list'] = $goodsAttrList[$goodsId][Attribute::SIZE_ATTR_ID];

                    foreach ($goodsAttrList[$goodsId][Attribute::SIZE_ATTR_ID] as $size) {
                        $key = "{$size['attr_type']}_{$size['id']}_{$size['attr_value']}";
                        $sizeKey = "{$size['attr_type']}_{$size['id']}";
                        $goods[$key] = 0;
                        if (isset($sizeList[$sizeKey])) {
                            $goods[$key] = $sizeList[$sizeKey];
                        }
                    }

                    $skuList[] = $goods;
                }
            }
            $this->skuList = $skuList;
            return $this;
        }
        return false;
    }

    public function attributes()
    {
        return $this->attributesArr;
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->attributesArr)) {
            return $this->{$name} = $value;
        }
        return parent::__set($name, $value);
    }
}