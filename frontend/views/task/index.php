<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $users  array */
?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description:ntext',
            'date',
            'responsible_id' => [
                'label' => 'Responsible',
                'value' => function ($data) {
                    return $data->responsible->username;
                },
            ],
            'initiator_id' => [
                'label' => 'Initiator',
                'value' => function ($data) {
                    return $data->initiator->username;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ])

    ?>

