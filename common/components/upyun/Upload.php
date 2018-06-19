<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/5/28
 * Time: 22:26
 */

namespace common\components\upyun;

use Upyun\Config;
use Upyun\Signature;
use Upyun\Upyun;
use Upyun\Util;
use yii\base\Component;

/**
 * 基于又拍云的功能
 *
 * Class Upyun
 * @package common\components\upyun
 */
class Upload extends Component
{
    public $serviceName;

    public $operatorName;

    public $operatorPwd;

    public $apiKey;

    public $preFixPath = '/test';

    public $baseUrl = '';

    /**
     * @var null | Upyun
     */
    protected $client = null;

    /**
     * @var Config
     */
    protected $serviceConfig;


    public function init()
    {
        $this->serviceConfig = new Config($this->serviceName, $this->operatorName, $this->operatorPwd);
        $this->serviceConfig->setFormApiKey($this->apiKey);
        $this->getClient();
        $this->preFixPath = '/' . trim($this->preFixPath, '/');
    }

    protected function getClient()
    {
        if ($this->client == null) {
            $this->client = new Upyun($this->serviceConfig);
        }

        return $this->client;
    }

    public function write($path, $content, $params = [])
    {
        $path = $this->preFixPath . $path;
        return $this->getClient()->write($path, $content, $params);
    }

    public function getBodySignature()
    {
        $data['save-key'] = app()->request->get('save_path', $this->preFixPath . '/{year}/{mon}/{filename}{.suffix}');
        $data['expiration'] = time() + 120;
        $data['bucket'] = $this->serviceName;
        $policy = Util::base64Json($data);
        $method = 'POST';
        $uri = '/' . $data['bucket'];
        $signature = Signature::getBodySignature($this->serviceConfig, $method, $uri, null, $policy);

        return [
            'policy' => $policy,
            'authorization' => $signature,
            'serviceName' => $this->serviceName,
        ];
    }

}