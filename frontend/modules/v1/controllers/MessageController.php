<?php

namespace frontend\modules\v1\controllers;

use common\models\filters\MessageFilter;
use common\models\tables\Message;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use common\models\User;

class MessageController extends ActiveController
{
    public $modelClass = Message::class;

    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authentificator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);
                if ($user != null && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            }
        ];
        return $behaviors;
    }
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        $filter = \Yii::$app->request->get('filter');

        //var_dump($filter); exit;
        $query = Message::find();;
        return new ActiveDataProvider([
            'query' => (new MessageFilter)->filter($filter, $query)
        ]);
    }

    /*   public function actions()
       {
           $actions = parent::actions();
           unset($actions['delete']);
           return $actions;      }

       /*  public function checkAccess($action, $model = null, $params = [])
         {
             if (!\Yii::$app->user->id){
                 throw new ForbiddenHttpException();
             }
         }*/
}