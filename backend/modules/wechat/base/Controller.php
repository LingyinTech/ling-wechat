<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/18
 * Time: 22:17
 */

namespace app\modules\wechat\base;

use Yii;

class Controller extends \app\base\Controller
{

    protected $wechat;

    public function init()
    {
        $this->wechat = Yii::$app->wechat->getInstance();

        parent::init();
    }

}