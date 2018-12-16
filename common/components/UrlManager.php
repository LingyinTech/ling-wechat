<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/12/17
 * Time: 1:10
 */

namespace common\components;


class UrlManager extends \yii\web\UrlManager
{

    public $subDomain = [];

    public $ruleConfig = ['class' => UrlRule::class];

}