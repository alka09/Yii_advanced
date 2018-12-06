<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\tables\TelegramOffset;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class TelegramController extends Controller
{

    /**@var Component */

    private $bot;
    private $offset = 0;

    public function init() {
        parent::init();
        $this->bot = \Yii::$app->bot;
    }

    public function actionIndex(){

        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        if ($updCount > 0){
            echo "Новых сообщений: " . $updCount . PHP_EOL;
            foreach ($updates as $update){

                $this->updateOffset($update);
                if ($message = $update->getMessage()) {
                    $this->processCommand($message);
                }
            }

        } else {
            echo "Новых сообщений нет" . PHP_EOL;
        }

    }

    private function getOffset(){

        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if ($max > 0) {
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update) {

        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s")
        ]);
        $model->save();

    }
    private function processCommand(Message $message){

        $params = explode(" ", $message->getText());
        $command = $params[0];

        $responce = "";
        switch ($command) {
            case '/help':
                $responce = "Доступные команды: \n";
                $responce .= "/help - список команд \n";
                $responce .= "/projec_create ##project_name##- создание нового проекта\n";
                $responce .= "/task_create ##responcible## - создание таска \n";
                $responce .= "/sp_create - подписка на создание проекта \n";
                break;
            case '/sp_create':
                $responce .= "Вы подписаны на оповещение о создании проекта";
                break;

        }
        $this->bot->sendMessage($message->getFrom()->getId(), $responce);
    }

}