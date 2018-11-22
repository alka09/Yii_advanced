<?php

namespace frontend\controllers;

use app\models\tables\TaskAttachments;
use app\models\tables\Tasks;
use app\models\tables\Users;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    public function actionIndex()
    {

        $month = date('n');
        //$id = 1;
        $id = Yii::$app->user->id;

        //var_dump($id);

        $provider = new ActiveDataProvider([
            'query' => Tasks::getTaskCurrentMonth($month, $id)
        ]);
        $users = ArrayHelper::map(Users::find()->all(), 'id', 'login');

        return $this->render('index', [
            'provider' => $provider,
            'users' => $users
        ]);
    }

    public function actionView($id)
    {
        $model = Tasks::findOne($id);
        return $this->render('view', ['model' => $model]);
    }

    protected function findModel($id)
    {
        if (($model = tasks::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $users = ArrayHelper::map(Users::find()->all(), 'id', 'login');
        return $this->render('update', [
            'model' => $model,
            'users' => $users
        ]);
    }

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
}