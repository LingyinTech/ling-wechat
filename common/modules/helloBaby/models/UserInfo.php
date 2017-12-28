<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 18:39
 */

namespace common\modules\helloBaby\models;

use common\base\helloBaby\ActiveRecord;
use Yii;
use yii\db\Exception;

/**
 * Class UserInfo
 * @package common\modules\helloBaby\models
 *
 * @property int $id 用户ID
 * @property int $account_id 账户ID
 * @property int $update_time 更新时间
 */
class UserInfo extends ActiveRecord
{

    public function checkLogin($openid, $accountToken = 0)
    {
        $user = self::findOne(['openid' => $openid]);
        $nowTime = time();
        if (empty($user)) {
            $trans = self::getDb()->beginTransaction();
            try {
                if (empty($accountToken) || empty($account = Account::findOne(['invite_token' => $accountToken]))) {
                    $api_token = md5(Yii::$app->params['miniAppAccountToken'].$nowTime);
                    $account = new Account();
                    $account->isNewRecord = true;
                    $account->setAttributes(['api_token' => $api_token, 'create_time' => $nowTime, 'update_time' => $nowTime], false);
                    if (!$account->save()) {
                        $trans->rollBack();
                        return false;
                    }
                }

                $this->isNewRecord = true;
                $this->setAttributes(['openid' => $openid, 'account_id' => $account->id, 'create_time' => $nowTime, 'update_time' => $nowTime], false);
                if (!$this->save()) {
                    $trans->rollBack();
                    return false;
                }
                $trans->commit();
                return [$account->api_token,$account->last_event_time];
            } catch (Exception $e) {
                print_r($e);
                $trans->rollBack();
            }
        } else {
            $user->update_time = $nowTime;
            if ($user->save()) {
                $account = Account::findOne(['id' => $user->account_id]);
                return [$account->api_token,$account->last_event_time];
            }
        }
        return ['',0];
    }

}