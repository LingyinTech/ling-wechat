<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2017/12/16
 * Time: 19:58
 */

namespace common\components;

use EasyWeChat\Factory;
use Yii;
use yii\base\Component;

class Wechat extends Component
{

    public $type = 'officialAccount';

    public $appId = null;
    public $secret = null;
    public $aesKey = null;
    public $token = null;
    public $responseType = 'array';
    public $logLevel = 'debug';
    public $logFile = null;

    /**
     * @var Factory 微信公众号实例
     */
    protected static $_instance = null;

    public function init()
    {
        if (empty($this->logFile)) {
            $this->logFile = Yii::$app->getRuntimePath() . '/logs/wechat/'.date('Y-m-d').'.log';
        }
    }

    /**
     * 获取微信
     *
     * @return Factory|mixed
     */
    public function getInstance()
    {
        if (self::$_instance == null) {
            $params = [
                'app_id' => $this->appId,
                'secret' => $this->secret,
                'aes_key' => $this->aesKey,
                'response_type' => $this->responseType,

                'log' => [
                    'level' => $this->logLevel,
                    'file' => $this->logFile,
                ],
            ];
            self::$_instance = call_user_func_array(['\EasyWeChat\Factory', $this->type], [$params]);
        }
        return self::$_instance;
    }

}