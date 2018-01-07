<?php
/**
 * Created by PhpStorm.
 * User: xiehuanjin
 * Date: 2018/1/6
 * Time: 14:15
 */

namespace common\components\swoole\task;

use common\components\swoole\server\TasksServer;
use yii\base\Component;

class TaskService extends Component
{

    public $psName;
    public $pidFile;

    public $swooleConfig = [];

    public function init()
    {
        if (!extension_loaded('swoole')) {
            exit('please install swoole first' . PHP_EOL);
        }

        if (!function_exists('exec')) {
            exit('exec function is disabled' . PHP_EOL);
        }

        exec("whereis lsof", $out);
        if ($out[0] == 'lsof:') {
            exit('lsof is not found' . PHP_EOL);
        }

        if (empty($this->psName)) {
            exit('psName can not be empty' . PHP_EOL);
        }

        if (empty($this->pidFile)) {
            $this->pidFile = app()->getRuntimePath() . '/pid/' . $this->psName;
        }
    }

    public function start()
    {
        echo "正在启动 swoole-task 服务" . PHP_EOL;
        if (!is_writable(dirname($this->pidFile))) {
            exit("swoole-task-pid文件需要目录的写入权限:" . dirname($this->pidFile) . PHP_EOL);
        }
        if (file_exists($this->pidFile)) {
            $pid = explode("\n", file_get_contents($this->pidFile));
            $cmd = "ps ax | awk '{ print $1 }' | grep -e \"^{$pid[0]}$\"";
            exec($cmd, $out);
            if (!empty($out)) {
                exit("swoole-task pid文件 " . $this->pidFile . " 存在，swoole-task 服务器已经启动，进程pid为:{$pid[0]}" . PHP_EOL);
            } else {
                echo "警告:swoole-task pid文件 " . $this->pidFile . " 存在，可能swoole-task服务上次异常退出(非守护模式ctrl+c终止造成是最大可能)" . PHP_EOL;
                unlink($this->pidFile);
            }
        }

        $server = new TasksServer($this->swooleConfig);
        $server->run();
        exit("启动 swoole-task 服务成功" . PHP_EOL);

    }

    public function reStart(){

    }

    public function stop()
    {
        echo "正在停止 swoole-task 服务" . PHP_EOL;
        if (!file_exists($this->pidFile)) {
            exit('swoole-task-pid文件:' . $this->pidFile . '不存在' . PHP_EOL);
        }
        $pid = explode("\n", file_get_contents($this->pidFile));
        $bind = swTaskPort($this->swooleConfig['port']);
        if (empty($bind) || !isset($bind[$pid[0]])) {
            exit("指定端口占用进程不存在 port:{$this->swooleConfig['port']}, pid:{$pid[0]}" . PHP_EOL);
        }
        $cmd = "kill {$pid[0]}";
        exec($cmd);
        do {
            $out = [];
            $c = "ps ax | awk '{ print $1 }' | grep -e \"^{$pid[0]}$\"";
            exec($c, $out);
            if (empty($out)) {
                break;
            }
        } while (true);
        //确保停止服务后swoole-task-pid文件被删除
        if (file_exists($this->pidFile)) {
            unlink($this->pidFile);
        }
        $msg = "执行命令 {$cmd} 成功，端口 {$this->swooleConfig['host']}:{$this->swooleConfig['port']} 进程结束" . PHP_EOL;
        exit($msg);
    }

    public function status()
    {
    }

    public function showList()
    {
        echo "本机运行的swoole-task服务进程" . PHP_EOL;
        $cmd = "ps aux|grep " . $this->psName . "|grep -v grep|awk '{print $1, $2, $6, $8, $9, $11}'";
        exec($cmd, $out);
        if (empty($out)) {
            exit("没有发现正在运行的swoole-task服务" . PHP_EOL);
        }
        echo "USER PID RSS(kb) STAT START COMMAND" . PHP_EOL;
        foreach ($out as $v) {
            echo $v . PHP_EOL;
        }
        exit();
    }
}