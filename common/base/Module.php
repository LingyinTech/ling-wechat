<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/2
 * Time: 16:44
 */

namespace common\base;

use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{

    public $domain = null;

    public $autoRedirect = false;

    public function init()
    {
        parent::init();
        if ($this->domain !== null) {
            $hostInfo = app()->request->getHostInfo();
            $hostDomain = str_replace(['https://', 'http://'], '', $hostInfo);
            if (0 !== strpos($hostDomain, $this->domain)) {
                if($this->autoRedirect) {
                    $domain = str_replace($hostDomain,$this->domain,app()->request->getAbsoluteUrl());
                    app()->response->redirect($domain);
                    app()->end();
                }
                throw new ForbiddenHttpException('Access Denied');
            }
        }
    }
}