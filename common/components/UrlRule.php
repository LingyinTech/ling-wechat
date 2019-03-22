<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/12/17
 * Time: 1:56
 */

namespace common\components;


class UrlRule extends \yii\web\UrlRule
{

    public function parseRequest($manager, $request) {
        return parent::parseRequest($manager,$request);
    }

}