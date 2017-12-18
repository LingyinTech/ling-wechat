<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/18
 * Time: 19:43
 */

namespace app\modules\wechat\controllers;

use app\modules\wechat\base\Controller;

/**
 * 菜单
 *
 * Class MenuController
 * @package app\modules\wechat\controllers
 */
class MenuController extends Controller
{

    public function actionApply()
    {
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key" => "V1001_TODAY_MUSIC"
            ],
            [
                "name" => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url" => "https://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "电影",
                        "url" => "https://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];

        $result = $this->wechat->menu->create($buttons);
        if ($result['errcode'] == 0) {
            return $this->asJson(['code' => 0, '应用成功']);
        } else {
            return $this->asJson(['code' => 0, '应用失败:' . $result['errmsg']]);
        }
    }

}