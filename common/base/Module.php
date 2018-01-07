<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/2
 * Time: 16:44
 */

namespace common\base;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{

    public $domain = null;

    public function init()
    {
        parent::init();
        if ($this->domain !== null) {
            $hostInfo = Yii::$app->request->getHostInfo();
            if (false === strpos($hostInfo, $this->domain)) {
                throw new ForbiddenHttpException('Access Denied');
            }
        }
    }
}