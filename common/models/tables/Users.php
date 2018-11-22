<?php

namespace common\models\tables;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\rbac\Role;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $role_id
 * @property string $email
 * @property Roles $role
 * @property integer $created_at
 * @property integer $updated_at
 */
class Users extends \yii\db\ActiveRecord
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
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'email'], 'required'],
            [['role_id'], 'integer'],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 128],
            [['login'], 'unique'],
            [['email'], 'string', 'max' => 128],
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
            'login' => 'Login',
            'password' => 'Password',
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
        return $this->hasMany(Tasks::className(), ['user_id' => 'id']);
    }


    public function addUser()
    {
        $user = new Users();
        $user->login = $this->login;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->role_id = $this->role_id;
        $user->email = $this->email;
//        var_dump($user->save());
        $user->save();
    }



}
