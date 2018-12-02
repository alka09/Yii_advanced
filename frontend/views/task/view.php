<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Task', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="tasks-view">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'description:ntext',
                'date',
                'responsible_id' =>
                    [
                        'label' => 'Responsible',
                        'value' => $model->responsible->username
                    ],
                'initiator_id' => [
                    'label' => 'Initiator',
                    'value' => $model->initiator->username
                ],
                'created_at',
                'updated_at'
            ],
        ]) ?>

    </div>