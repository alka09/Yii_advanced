<?php

namespace console\controllers;

use yii\console\Controller;
use common\rbac\UserGroupRule;


class RbacController extends Controller
{

    public function actionIndex()
    {
        $authManager = \Yii::$app->authManager;

//create roles
        $guest = $authManager->createRole('guest');
        $user = $authManager->createRole('user');
        $admin = $authManager->createRole('admin');
        $productManager = $authManager->createRole('productManager');

        //create permission
        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $signUp = $authManager->createPermission('sign-up');
        $index = $authManager->createPermission('index');
        $view = $authManager->createPermission('view');
        $createTask = $authManager->createPermission('createTask');
        $updateTask = $authManager->createPermission('updateTask');
        $deleteTask = $authManager->createPermission('deleteTask');

        //add permission in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($createTask);
        $authManager->add($updateTask);
        $authManager->add($deleteTask);

        //add rule
        $userGroupRule = new \app\rbac\UserGroupRule();
        $authManager->add($userGroupRule);

        //add rule "UserGroupRule" in roles
        $guest->ruleName = $userGroupRule->name;
        $user->ruleName = $userGroupRule->name;
        $productManager->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;

        //add role in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($productManager);
        $authManager->add($admin);

        //распределяем роли
        //guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $index);

        //user
        $authManager->addChild($user, $view);
        $authManager->addChild($user, $guest);

        //productManager
        $authManager->addChild($productManager, $createTask);
        $authManager->addChild($productManager, $user);

        //admin
        $authManager->addChild($admin, $updateTask);
        $authManager->addChild($admin, $deleteTask);
        $authManager->addChild($admin, $productManager);


    }
}
