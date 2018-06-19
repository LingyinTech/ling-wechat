<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/30
 * Time: 22:37
 */

namespace backend\modules\orderFlow\controllers;


use backend\modules\orderFlow\models\InvoiceType;
use backend\modules\orderFlow\models\OrderState;
use backend\modules\orderFlow\models\OrderType;
use backend\modules\orderFlow\models\PayMethod;
use common\base\Controller;

class ParamsController extends Controller
{

    public function actionPayMethod()
    {
        $model = new PayMethod();
        if (app()->request->isPost) {
            $data = app()->request->post('PayMethod');
            if ($model->saveData($data)) {
                return $this->success('保存成功');
            }
            return $this->fail('保存失败');
        }

        $list = $model->getList([]);

        return $this->render('pay-method', [
            'model' => $model,
            'list' => $list
        ]);
    }

    public function actionOrderType()
    {

        $model = new OrderType();
        if (app()->request->isPost) {
            $data = app()->request->post('OrderType');
            if ($model->saveData($data)) {
                return $this->success('保存成功');
            }
            return $this->fail('保存失败');
        }

        $list = $model->getList([]);

        return $this->render('order-type', [
            'model' => $model,
            'list' => $list
        ]);
    }

    public function actionOrderState()
    {
        $model = new OrderState();
        if (app()->request->isPost) {
            $data = app()->request->post('OrderState');
            if ($model->saveData($data)) {
                return $this->success('保存成功');
            }
            return $this->fail('保存失败');
        }

        $list = $model->getList([]);

        return $this->render('order-state', [
            'model' => $model,
            'list' => $list
        ]);
    }

    public function actionInvoiceType()
    {
        $model = new InvoiceType();
        if (app()->request->isPost) {
            $data = app()->request->post('InvoiceType');
            if ($model->saveData($data)) {
                return $this->success('保存成功');
            }
            return $this->fail('保存失败');
        }

        $list = $model->getList([]);

        return $this->render('invoice-type', [
            'model' => $model,
            'list' => $list
        ]);
    }

}