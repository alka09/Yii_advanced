<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
/**@var $users array */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin([
        'id' => 'task_create',
    ]); ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <? /*echo \yii\jui\DatePicker::widget([
            'model' => $model,
        'attribute' => 'date',
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'ru'

    ]);*/ ?>
    <?php ActiveForm::end(); ?>

</div>
