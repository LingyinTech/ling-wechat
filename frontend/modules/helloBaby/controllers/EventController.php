<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 15:35
 */

namespace frontend\modules\helloBaby\controllers;

use common\modules\helloBaby\models\Account;
use common\modules\helloBaby\models\EventInfo;
use frontend\modules\helloBaby\base\Controller;
use Yii;

class EventController extends Controller
{
    public function actionMonth()
    {
        $api_token = Yii::$app->request->get('api_token');
        if (empty($api_token) || empty($account = Account::findOne(['api_token' => $api_token]))) {
            return $this->fail('api_token不存在' . $api_token);
        }

        $month = Yii::$app->request->get('month');
        $list = (new EventInfo())->getOneMonthEventList($month,$account->id);

        return $this->format(['list' =>$list]);
    }

    public function actionUpdate()
    {

        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();

            $api_token = $params['api_token'];
            if (empty($api_token) || empty($account = Account::findOne(['api_token' => $api_token]))) {
                return $this->fail('api_token不存在' . $api_token);
            }

            $nowTime = time();
            $model = EventInfo::findOne(['account_id' => $account->id, 'date' => $params['date'], 'event_type' => $params['event_type']]);
            if (empty($model)) {
                $model = new EventInfo();
                $result = $model->saveData([
                    'account_id' => $account->id,
                    'date' => $params['date'],
                    'event_type' => $params['event_type'],
                    'status' => $params['status'],
                    'create_time' => $nowTime,
                    'update_time' => $nowTime
                ], true);
            } else {
                $model->status = $params['status'];
                $model->update_time = $nowTime;
                $result = $model->save();
            }
            return $this->format(['status'=> $result ? 0 : 1,'last_event_time' => $nowTime]);
        }

        $api_token = Yii::$app->request->get('api_token');
        if (empty($api_token) || empty($account = Account::findOne(['api_token' => $api_token]))) {
            return $this->fail('api_token不存在' . $api_token);
        }
        $date = Yii::$app->request->get('date');
        $result = (new EventInfo())->getOneDayEventList(['date' => $date, 'account_id' => $account->id]);

        return $this->format($result);
    }
}