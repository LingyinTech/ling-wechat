<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/12/17
 * Time: 1:10
 */

namespace common\components;


use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\Request;

class UrlManager extends \yii\web\UrlManager
{

    public $subDomains = [];

    public $ruleConfig = ['class' => UrlRule::class];

    protected $_hostInfo;

    public function createAbsoluteUrl($params, $scheme = null)
    {
        $params = (array) $params;
        $url = $this->createUrl($params);
        if (strpos($url, '://') === false) {
            $hostInfo = $this->getHostInfo();
            if (strncmp($url, '//', 2) === 0) {
                $url = substr($hostInfo, 0, strpos($hostInfo, '://')) . ':' . $url;
            } else {
                $url = $hostInfo . $url;
            }
        }

        return Url::ensureScheme($url, $scheme);
    }

    public function getHostInfo()
    {
        if ($this->_hostInfo === null) {
            $request = app()->getRequest();
            if ($request instanceof Request) {
                $this->_hostInfo = $request->getHostInfo();
            } else {
                throw new InvalidConfigException('Please configure UrlManager::hostInfo correctly as you are running a console application.');
            }
        }

        return $this->_hostInfo;
    }

}