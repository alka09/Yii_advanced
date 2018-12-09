<?php

namespace common\models\tables;

use SonkoDmitry\Yii\TelegramBot\Component;
use Yii;


/**
 * This is the model class for table "telegram_subscribe".
 *
 * @property int $id
 * @property int $chat_id
 * @property string $channel
 */
class TelegramSubscribe extends \yii\db\ActiveRecord
{
    const CHANNEL_PROJECT_CREATE = 'project_create';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_subscribe';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id'], 'integer'],
            [['channel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chat_id' => Yii::t('app', 'Chat ID'),
            'channel' => Yii::t('app', 'Channel'),
        ];
    }

    public function getChatId(){
        /** @var Component $bot */
        $bot = Yii::$app->bot;
        $updates = $bot->getUpdates();
        foreach ($updates as $update) {
            $id = $update->getMessage()->getFrom()->getId();
        }
        return $id;
    }

    public function getAddSubscriber(){

        $id = TelegramSubscribe::getChatId();

        $addSubscriber = new TelegramSubscribe([
            'chat_id' => $id,
           // 'channel' => $channel
        ]);
        $addSubscriber->save();
    }

    public function delSubscriber(){
        $id = TelegramSubscribe::getChatId();
        $delChatId = TelegramSubscribe::find()
            ->where(['chat_id' => $id])
            ->one();
        $delChatId->delete();
    }
    public static function getSendSubscriber()
    {
        /**@var Component $bot */
        $bot = \Yii::$app->bot;
        $users = TelegramSubscribe::find()
            ->where('chat_id')
            ->all();

        $newProject = Project::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(1)
            ->one();

        $projectId = $newProject['id'];
        $link = "http://front.yii.local/project/view?id={$projectId}";

        foreach ($users as $user) {
            $usersSend = $user['chat_id'];
            $bot->sendMessage($usersSend, "Создан новый проект {'$link''}");
        }
    }
}
