<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/11/19
 * Time: 20:53
 */

namespace backend\base;
use backend\models\User;
use yii\db\Connection;


/**
 * Class Application
 * @package backend\base
 *
 * @property Connection $baseDb The database connection. This property is read-only.
 * @property Connection $orderFlowDb The database connection. This property is read-only.
 */
class Application extends \common\base\Application
{

}