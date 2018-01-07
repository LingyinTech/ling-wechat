<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/6
 * Time: 14:54
 */

namespace common\components\swoole;

use Yii;
abstract class Server
{
    protected $listHost = '0.0.0.0';
    protected $listPort = '9502';

    protected $taskLogic = null;

    protected $params = [];

    public function __construct(array $params = [])
    {
        if(empty($params['taskLogic'])){
            exit('taskLogic can not be empty' . PHP_EOL);
        }
        $this->taskLogic = Yii::createObject($params['taskLogic']);

        if(isset($params['host'])){
            $this->listHost = $params['host'];
        }
        if(isset($params['port'])){
            $this->listPort = $params['port'];
        }

        unset($params['host'],$params['port'],$params['taskLogic']);
        $this->params = $params;

        $this->init();
    }

    public function init()
    {
    }

    abstract function run();

}