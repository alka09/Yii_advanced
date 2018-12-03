<?php

namespace common\models\tables;

use Yii;
use common\models\User;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $creator
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $creator0
 * @property Tasks[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSE = 2;

    public static function getStatusArray(){
        return [
          self::STATUS_ACTIVE =>'Активен',
            self::STATUS_INACTIVE => 'Неактивен',
            self::STATUS_CLOSE => 'Закрыт',
        ];
    }

    public function getStatus(){
        if ($this-> status === null) {
            $statuses = self::getStatusArray();
            $this-> status = $statuses[$this-> status];
        }
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['creator'], 'required'],
            [['creator', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['creator'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'creator' => Yii::t('app', 'Creator'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator0()
    {
        return $this->hasOne(User::className(), ['id' => 'creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['project_id' => 'id']);
    }
}
