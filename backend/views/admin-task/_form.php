<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\tables\Tasks */
/* @var $form yii\widgets\ActiveForm */
/**@var $users array */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin([
        'id' => 'task_create',
    ]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'responsible_id')->dropDownList($users)->label('Responsible') ?>
    <?= $form->field($model, 'initiator_id')->dropDownList($users)->label('Initiator') ?>
    <?= $form->field($model, 'project_id')->dropDownList($project)->label('Name') ?>
    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
            'dateFormat' => 'yyyy-MM-dd',
            'language' => 'ru']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <? /*echo \yii\jui\DatePicker::widget([
            'model' => $model,
        'attribute' => 'date',
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'ru'

    ]);*/ ?>
    <?php ActiveForm::end(); ?>

</div>
