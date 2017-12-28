<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 15:51
 */

namespace common\modules\helloBaby\models;


use common\base\helloBaby\ActiveRecord;

/**
 * Class EventInfo
 * @package common\modules\helloBaby\models
 *
 * @property int $account_id 账户ID
 * @property int $status 事情状态
 * @property int $update_time 更新时间
 */
class EventInfo extends ActiveRecord
{

    public function getOneMonthEventList($params)
    {
        $result = [];

        if (empty($params['date']) && empty($params['account_id'])) {
            return $result;
        }

        $list = $this->getList($params);
        if (empty($list)) {
            return $result;
        }
        foreach ($list as $item) {
            $day = substr($item['date'], 6, 2);
            $day = intval($day) - 1;
            if ($item['event_type'] == 1) {
                $result[$day]['make_love'] = $item['status'];
            } elseif ($item['event_type'] == 2) {
                $result[$day]['menstruation'] = $item['status'];
            } elseif ($item['event_type'] == 3) {
                $result[$day]['pregnant'] = $item['status'];
            }
        }
        return $result;
    }

    public function getOneDayEventList($params)
    {
        $result = ['make_love' => 0, 'menstruation' => 0, 'pregnant' => 0];

        if (empty($params['date']) && empty($params['account_id'])) {
            return $result;
        }

        $list = $this->getList($params);
        if (empty($list)) {
            return $result;
        }

        foreach ($list as $item) {
            if ($item['event_type'] == 1) {
                $result['make_love'] = $item['status'];
            } elseif ($item['event_type'] == 2) {
                $result['menstruation'] = $item['status'];
            } elseif ($item['event_type'] == 3) {
                $result['pregnant'] = $item['status'];
            }
        }
        return $result;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!empty($this->account_id) && $accountModel = Account::findOne($this->account_id)) {
            $accountModel->last_event_time = $this->update_time;
            $accountModel->save(false);
        }

        parent::afterSave($insert, $changedAttributes);
    }

}