<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/18
 * Time: 19:43
 */

namespace app\controllers;

use app\base\Controller;
use Yii;

class WechatMenuController extends Controller
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
                        "url" => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url" => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $wechat = Yii::$app->wechat->getInstance();
        $result = $wechat->menu->create($buttons);
        if ($result['errcode'] == 0) {
            return $this->asJson(['code' => 0, '应用成功']);
        } else {
            return $this->asJson(['code' => 0, '应用失败:'.$result['errmsg']]);
        }
    }

}