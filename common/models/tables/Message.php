<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @peperty User $user
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function fields()
    {
        {
            return ['id', 'email', 'username'];
        }
    }
    public function extraFields()
    {
        return [
            'status'
        ];
    }

}
