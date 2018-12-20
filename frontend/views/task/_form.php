<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\tables\tasks */
/* @var $form yii\widgets\ActiveForm */
/* @var $users  array */
/* @var $project  array */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'responsible_id')->dropDownList($users)->label('Responsible') ?>

    <?= $form->field($model, 'initiator_id')->dropDownList($users)->label('Initiator') ?>

    <?= $form->field($model, 'project_id')->dropDownList($project)->label('Project') ?>

    <?= $form->field($model, 'date')->widget(\yii\jui\DatePicker::class, [
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'ru'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>