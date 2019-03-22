<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 18:47
 */

namespace common\modules\helloBaby\models;


use common\modules\helloBaby\ActiveRecord;

/**
 * Class Account
 * @package common\modules\helloBaby\models
 *
 * @property int $id  账户ID
 * @property string $api_token 账户Token
 * @property int $last_event_time 最后记录时间
 */
class Account extends ActiveRecord
{

}