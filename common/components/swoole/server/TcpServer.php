<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/6
 * Time: 15:01
 */

namespace common\components\swoole\server;


use common\components\swoole\Server;

class TcpServer extends Server
{

    function run()
    {
        $server = new \Swoole\Server($this->listHost, $this->listPort);
        $server->set($this->params);

        //回调函数
        $call = [
            'start',
            'workerStart',
            'managerStart',
            'request',
            'receive',
            'task',
            'finish',
            'workerStop',
            'shutdown',
        ];
        //事件回调函数绑定
        foreach ($call as $v) {
            $m = 'on' . ucfirst($v);
            if (method_exists($this->taskLogic, $m)) {
                $server->on($v, [$this->taskLogic, $m]);
            }
        }
        $server->start();
    }
}