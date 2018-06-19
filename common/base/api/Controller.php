<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/24
 * Time: 18:00
 */

namespace common\base\api;


class Controller extends \common\base\Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {
        $content = file_get_contents('php://input');
        $_POST = json_decode($content, true);
        parent::init();
    }

}