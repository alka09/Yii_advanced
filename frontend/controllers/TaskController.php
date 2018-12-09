<?php

namespace frontend\controllers;

use common\models\tables\ImageUpload;
use common\models\tables\Chat;
use common\models\tables\TelegramSubscribe;
use Yii;
use common\models\tables\Tasks;
use common\models\tables\Users;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use SonkoDmitry\Yii\TelegramBot\Component;


class TaskController extends ActiveController
{

    public $modelClass = Tasks::class;

    public function actionIndex()
    {

        $month = date('n');
        //$id = 1;
        $id = Yii::$app->user->id;

        //var_dump($id);

        $provider = new ActiveDataProvider([
            'query' => Tasks::getTaskCurrentMonth($month, $id)
        ]);

        $user = ArrayHelper::map(User::find()->all(), 'id', 'username');
//var_dump($user);
        return $this->render('index', [
            'provider' => $provider,
            'user' => $user
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionOne($id)
    {
        $model = Tasks::findOne($id);
        $channel ="task_{$id}";
        return $this->render("one", [
            'model' => $model,
            'history' => Chat::getChannelHistory($channel),
            'channel' => $channel,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Updates an existing tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $users = ArrayHelper::map(Users::find()->all(), 'id', 'username');
        return $this->render('update', [
            'model' => $model,
            'users' => $users
        ]);
    }

    /**
     * Updates an existing tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    // public function actionTest()
    // {
    //    Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function ($event) {
    //       $task = new Tasks([
    //            'name' => 'Ознакомиться с проектом',
    //            'date' => date("Y-m-d"),
    //            'description' => 'Новый проект',
    //            'user_id' => $event->sender->id
    //        ]);
    //        $task->save();
    //    });

    //$user = new Users();
    //$user->login = 'Vasechkim';
    //$user->password = 'qwerty';
    //$user->save();

    //}

    public
    function actionCache()
    {
        $number = rand();
        $key = 'number';
        $cache = \Yii::$app->cache;

        if ($cache->exists($key)) {
            $number = $cache->get($key);
        }
        \Yii::$app->cache->set("number", $number);

        //var_dump($number);
        exit;

    }

    public function actionTest(){

    }
}