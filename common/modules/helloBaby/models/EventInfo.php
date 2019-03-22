<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 15:51
 */

namespace common\modules\helloBaby\models;


use common\modules\helloBaby\ActiveRecord;

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

    public function getOneMonthEventList($month, $accountId)
    {
        $result = [];
        if (empty($month) || empty($accountId)) {
            return $result;
        }
        $params = ['like' => ['date' => "$month%"], 'account_id' => $accountId];
        $list = $this->getList($params);

        $firstDay = intval($month . '01');
        $dayLength = date('t', strtotime("{$month}10")) - 1;
        foreach ($list as $item) {
            $day = substr($item['date'], 6, 2);
            $day = intval($day) - 1;

            if ($item['event_type'] == 1) {
                $result[$day]['make_love'] = $item['status'];
            } elseif ($item['event_type'] == 2) {
                $result[$day]['menstruation'] = $item['status'];
            } elseif ($item['event_type'] == 3) {
                $result[$day]['menstruation_off'] = $item['status'];
            } elseif ($item['event_type'] == 10) {
                $result[$day]['pregnant'] = $item['status'];
            }
        }

        // 上个月月经开始，没有结束
        if ($maxLastMsDate = $this->getMaxLastMsDate($month, $accountId)) {
            if (($maxLastMsOffDate = $this->getMaxLastMsOffDate($month, $accountId)) === false || $maxLastMsOffDate < $maxLastMsDate) {
                if (($minInMaxOffDate = $this->getMinInOffDate($month, $accountId)) === false) {
                    $minInMaxOffDate = date('Ymd', strtotime("$maxLastMsDate +6 day"));
                }
                if ($minInMaxOffDate >= $firstDay) {
                    $index = intval(substr($minInMaxOffDate, 6, 2)) - 1;
                    for ($i = 0; $i <= $index; $i++) {
                        $result[$i]['menstruation'] = 2; // 月经过程
                    }
                }
            }
        }

        // 当月经期情况
        $menstruation = [];
        $menstruationOff = [];
        foreach ($result as $key => $item) {
            if (isset($item['menstruation']) && $item['menstruation'] == 1) {
                $menstruation[] = $key;
            }
            if (isset($item['menstruation_off']) && $item['menstruation_off'] == 1) {
                $menstruationOff[] = $key;
            }
        }
        foreach ($menstruation as $index) {
            do {
                $endIndex = array_shift($menstruationOff);
            } while ($endIndex <> null && $endIndex < $index);
            $startIndex = $index + 1;
            empty($endIndex) && $endIndex = $index + 7;
            for ($i = $startIndex; $i < $endIndex && $i <= $dayLength; $i++) {
                $result[$i]['menstruation'] = 2;
            }
        }

        return $result;
    }

    public function getMinInOffDate($month, $accountId)
    {
        $params = [
            'select' => 'min(`date`) as date',
            'account_id' => $accountId,
            '>=' => ['date' => "{$month}01"],
            'event_type' => 3,
        ];
        if ($data = $this->getOne($params)) {
            return empty($data['date']) ? false : $data['date'];
        }
        return false;
    }

    public function getMaxLastMsDate($month, $accountId)
    {
        $params = [
            'select' => 'MAX(`date`) as date',
            'account_id' => $accountId,
            '<' => ['date' => "{$month}01"],
            'event_type' => 2,
            'status' => 1
        ];
        if ($data = $this->getOne($params)) {
            return empty($data['date']) ? false : $data['date'];
        }
        return false;
    }

    public function getMaxLastMsOffDate($month, $accountId)
    {
        $params = [
            'select' => 'MAX(`date`) as date',
            'account_id' => $accountId,
            '<' => ['date' => "{$month}01"],
            'event_type' => 3,
            'status' => 1
        ];
        if ($data = $this->getOne($params)) {
            return empty($data['date']) ? false : $data['date'];
        }
        return false;
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