<?php

use yii\helpers\Html;
?>

<h2>Администрирование</h2>
<p><?= Html::a('users' ,['users/'], ['class' => 'btn btn-success'])  ?></p>
<p><?= Html::a('admin-task' ,['admin-task/'], ['class' => 'btn btn-success']) ?></p>
<p><?= Html::a('roles' ,['roles/'], ['class' => 'btn btn-success']) ?></p>
