<?php

namespace console\controllers;

use console\components\WsServer;
use yii\console\Controller;

class ServerController extends Controller
{

    public function actionWs()
    {
        $server = \Ratchet\Server\IoServer::factory(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new WsServer()
                )
            ),
            8080
        );

        $server->run();
    }
}