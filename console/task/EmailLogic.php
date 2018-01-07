<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/7
 * Time: 17:49
 */

namespace console\task;
use Swoole\Server;

/**
 * Class EmailLogic
 * @package cosole\task
 */
class EmailLogic
{
    /**
     * //回调函数
     * $call = [
     * 'Start',
     * 'workerStart',
     * 'managerStart',
     * 'request',
     * 'receive',
     * 'task',
     * 'finish',
     * 'workerStop',
     * 'shutdown',
     * ];
     */

    /**
     * @param Server $server
     * @param $fd
     * @param $reactor_id
     * @param mixed $data
     */
    public function onReceive($server, $fd, $reactor_id, $data)
    {
        $data = trim($data);
        $task_id = $server->task($data);
        echo "Dispath AsyncTask: [id=$task_id]".PHP_EOL;
    }

    public function onTask($server, $task_id, $reactor_id, $data)
    {
        echo "New AsyncTask[id=$task_id]\n";
        app()->wechat->getInstance()->template_message->send([
            'touser' => 'ox4bCt0wZR9itFdps3lbY4JmgAtE',
            'template_id' => '0deSUEgWQLJ8egIuPPv3gRvXNXXBp1Ky8QQMOXlN9W0',
            'url' => 'http://wechat.lingyin99.com',
            'data' => [
                'amount' => '100.00'
            ],
        ]);
        $server->finish("$data -> OK");
    }

    public function onFinish($server, $task_id, $data)
    {
        echo "AsyncTask[$task_id] finished: {$data}\n";
        var_dump(spl_object_hash(app()));
    }
}