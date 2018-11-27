<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name',
        'description:html',
        'date',
    ],

]) ?>
