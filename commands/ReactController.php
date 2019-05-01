<?php

namespace app\commands;


use React\EventLoop\Factory;
use React\Socket\Server;
use yii\console\Controller;

class ReactController extends Controller
{
    public function actionEventLoop()
    {
        global $connections;

        $connections = [];
        $loop = Factory::create();
        $serv = new Server('127.0.0.1:8080', $loop);
        $serv->on('connection', function($conn) {

            global $connections;

            $connections[] = $conn;
            foreach ($connections as $conn) {
                $conn->write('new connection' . PHP_EOL);
            }

            $conn->on('data', function ($data) {

                global $connections;

                foreach ($connections as $conn) {
                    $conn->write($data);
                }
            });
        });

        $loop->run();
    }
}