<?php

namespace common\components;

use common\models\tables\Project;
use common\models\tables\TelegramSubscribe;
use yii\base\Application;
use yii\base\Component;
use yii\base\Event;

class CreateProjectComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Project::class, Project::EVENT_AFTER_INSERT, function (Event $event){
            $model = $event->sender;
            TelegramSubscribe::getSendSubscriber();
        });
    }
//public function bootstrap($app)
//{
 //   Event::on(Project::class, Project::EVENT_AFTER_INSERT, function($e){
 //       $name = $e->sender->name;
 //       $message = "Создан новый проект \"{$name}\"";
 //       $subscribers = TelegramSubscribe::find()
//            ->select('chat_id')
 //           ->where(['channel' => TelegramSubscribe::CHANNEL_PROJECT_CREATE])
 //           ->column();
 //       foreach ($subscribers as $subscriber){
 //           /**@var \SonkoDmitry\Yii\TelegramBot\Component $bot */
//            $bot = \Yii::$app->bot;
//           $bot->sendMessage($subscriber, $message)   ;
 //       }
//
//    });
//}
}