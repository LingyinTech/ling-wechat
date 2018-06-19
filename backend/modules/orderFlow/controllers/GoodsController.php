<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/24
 * Time: 23:43
 */

namespace backend\modules\orderFlow\controllers;


use backend\modules\orderFlow\models\Attribute;
use backend\modules\orderFlow\models\Goods;
use backend\modules\orderFlow\models\GoodsAttr;
use common\base\Controller;

class GoodsController extends Controller
{

    public function actionPop()
    {

        $index = app()->request->get('index', 0);

        $list = (new Goods())->getList(['is_on_sale' => 1]);

        return $this->renderPartial('pop', [
            'list' => $list,
            'index' => $index,
        ]);
    }

    public function actionAttr()
    {
        $params['goods_id'] = app()->request->get('goods_id');
        $params['is_on_sale'] = 1;

        $data = (new GoodsAttr())->getAllAttr($params);

        return $this->format([
            'color' => isset($data[Attribute::COLOR_ATTR_ID]) ? $data[Attribute::COLOR_ATTR_ID] : [],
            'size' => isset($data[Attribute::SIZE_ATTR_ID]) ? $data[Attribute::SIZE_ATTR_ID] : [],
        ]);
    }

}