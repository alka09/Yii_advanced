<?php

namespace common\rbac;

use yii\rbac\Rule;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $role = \Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $role == 'admin';
            } elseif ($item->name === 'user') {
                return $role == 'admin' || $role == 'user';
            }elseif ($item->name === 'projectManager') {
                return $role == 'admin' || $role == 'projectManager';
            }
        }
        return true;
    }



}