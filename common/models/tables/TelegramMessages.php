<?php

namespace common\models\tables;

use SonkoDmitry\Yii\TelegramBot\Component;
use yii\db\ActiveRecord;

class TelegramMessages extends ActiveRecord
{
    public function getTelegramMessages()
    {
        /**@var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        $updates = $bot->getUpdates();
        //var_dump($updates);
        //exit;

        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $username = $message->getFrom()->getUsername();
            //$user_id = $message->getFrom()->getId();
            $messages[] = [
                'text' => $message->getText(),
                'username' => $username,
                //'user_id' => $user_id,
            ];
        }
        //var_dump($messages); exit;
        return $messages;
    }

    public static function getSendUser($id, $messages)
    {
        /** @var Component $bot */
        $bot = \Yii::$app->bot;
        $bot->sendMessage($id, $messages);
    }

}