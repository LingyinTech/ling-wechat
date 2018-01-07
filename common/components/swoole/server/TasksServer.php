<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/6
 * Time: 15:02
 */

namespace common\components\swoole\server;


class TasksServer extends TcpServer
{

    public function init()
    {
        if (empty($this->params['task_worker_num']) || $this->params['task_worker_num'] < 1) {
            exit("must set the 'taskWorkerNum' parameter" . PHP_EOL);
        }
    }
}