<?php

namespace common\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\rbac\Role;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property int $role_id
 * @property string $email
 * @property Tasks[] $tasks
 */
class Users extends ActiveRecord
{

    static public $users;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['role_id'], 'integer'],
            [['email'], 'email'],
            [['username'], 'unique', 'targetClass' => Users::className(), 'message' => 'Этот логин уже занят'],
            [['email'], 'unique', 'targetClass' => Users::className(), 'message' => 'Данный email уже зарегестрирован'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'UserName',
            'password_hash' => 'Password_hash',
            'role_id' => 'Role ID',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['responsible_id' => 'id']);
    }


    public function getAddUser()
    {
        $user = new Users();
        $user->username = $this->username;
        $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password_hash);
        $user->role_id = $this->role_id;
        $user->email = $this->email;
        return $user->save();
//        var_dump($user->save());
        $user->save();
    }
}
