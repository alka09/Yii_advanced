<?php

namespace frontend\controllers;

use common\models\tables\TelegramMessage;
use common\models\tables\TelegramMessages;
use yii\web\Controller;

class TelegramController extends Controller
{
    /**
     * @return string
     * @throws \TelegramBot\Api\Exception
     * @throws \TelegramBot\Api\InvalidArgumentException
     */

    public function actionReceive()
    {
        $messages = TelegramMessages::getTelegramMessages();
        return $this->render('receive', [
            'messages' => $messages
        ]);
    }

    public function actionSend()
    {
        TelegramMessages::getSendUser(357183223, 'Это бот или не бот?');
    }
}


