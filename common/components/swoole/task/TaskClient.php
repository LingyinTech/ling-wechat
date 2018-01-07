<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/1/7
 * Time: 20:37
 */

namespace common\components\swoole\task;


use Swoole\Client;
use yii\base\Component;

class TaskClient extends Component
{

    public function init()
    {

    }

    public function send($message){
        $client = new Client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $ret = $client->connect('127.0.0.1', 9502);
        if(empty($ret)){
            echo '任务推送失败';
        } else {
            $client->send($message);
        }
        echo $client->recv();
        $client->close();
    }
}