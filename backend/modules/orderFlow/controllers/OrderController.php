<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/4/23
 * Time: 22:33
 */

namespace backend\modules\orderFlow\controllers;


use backend\modules\orderFlow\models\form\OrderInfoForm;
use backend\modules\orderFlow\models\InvoiceType;
use backend\modules\orderFlow\models\OrderInfo;
use backend\modules\orderFlow\models\OrderType;
use backend\modules\orderFlow\models\PayMethod;
use common\base\Controller;

class OrderController extends Controller
{

    public function actionDelete()
    {
        $params['id'] = app()->request->get('id');
        if (empty($params['id'])) {
            return $this->fail('参数错误');
        }
        $params['is_delete'] = 0;
        if (!($orderInfo = OrderInfo::findOne($params))) {
            return $this->fail('订单不存在或无权限');
        }
        $orderInfo->is_delete = 1;
        if ($orderInfo->save(false)) {
            return $this->success('删除成功');
        }

        return $this->fail('删除失败');
    }

    public function actionCreate()
    {
        $id = app()->request->get('id');
        if (!empty($id)) {
            $model = OrderInfo::findOne($id);
        }
        empty($model) && $model = new OrderInfo();

        if (app()->request->isPost) {
            if (($result = $model->saveOrder()) !== true) {
                if (is_string($result)) {
                    return $this->fail('保存失败' . $result);
                }
                return $this->format(['status' => 1, 'msg' => '保存失败', 'data' => $result]);
            }
            return $this->success('保存成功');
        }

        $modelForm = new OrderInfoForm();
        $csrf = app()->request->getCsrfToken();

        if (!empty($model)) {
            $modelForm->loadData($model);
            $model->order_time = $modelForm->order_time;
            $model->plan_time = $modelForm->plan_time;
        }

        return $this->render('create', [
            'model' => $model,
            'modelForm' => $modelForm,
            'invoiceTypeList' => (new InvoiceType())->getCache(),
            'orderTypeList' => (new OrderType())->getCache(),
            'payMethodList' => (new PayMethod())->getCache(),
            '_csrf' => $csrf,
        ]);
    }

    public function actionPrint()
    {
        $id = app()->request->get('id');
        if (!empty($id)) {
            $model = OrderInfo::findOne($id);
        }
        if (empty($model)) {
            $this->render('error');
        }

        $modelForm = new OrderInfoForm();
        $csrf = app()->request->getCsrfToken();

        if (!empty($model)) {
            $modelForm->loadData($model);
            $model->order_time = $modelForm->order_time;
            $model->plan_time = $modelForm->plan_time;
        }

        return $this->renderPartial('create', [
            'model' => $model,
            'modelForm' => $modelForm,
            'invoiceTypeList' => (new InvoiceType())->getCache(),
            'orderTypeList' => (new OrderType())->getCache(),
            'payMethodList' => (new PayMethod())->getCache(),
            '_csrf' => $csrf,
        ]);
    }

    public function actionIndex()
    {
        $orderState = app()->request->get('order_state');

        $params = [];
        if ($orderState !== null) {
            $params['order_state'] = $orderState;
        }

        $keyword = app()->request->get('keyword');
        if (!empty($keyword)) {
            $params['like'] = [
                'order_sn' => $keyword
            ];
        }


        $filter = [
            'keyword' => $keyword,
        ];

        $list = (new OrderInfo())->getList($params);

        return $this->render('index', [
            'list' => $list,
            'filter' => $filter,
        ]);
    }

}