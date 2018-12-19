<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\rbac\UserRoleRule;


class RbacController extends Controller
{
    public function actionInit(){

        $auth = Yii::$app->authManager;

        $auth->removeAll(); //на всякий случай удаляем старые данные из БД

        //Создаем роли
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $projectManager = $auth->createRole('projectManager');
        $projectManager->description = 'Менеджер проекта';

        $auth->add($admin);
        $auth->add($user);
        $auth->add($projectManager);

        //Создаем разрешения
        $viewAdminPage =  $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Редактирование проекта';

        $deleteProject = $auth->createPermission('deleteProjet');
        $deleteProject->description = 'Удаление проекта';

        $updateTask = $auth->createPermission('updateTask');
        $updateTask->description = 'Редактирование задачи';


        $auth->add($viewAdminPage);
        $auth->add($updateProject);
        $auth->add($deleteProject);
        $auth->add($updateTask);

        //Присваиваем разрешения ролям (наследования)
        $auth->addChild($projectManager, $updateProject);
        $auth->addChild($projectManager, $deleteProject);
        $auth->addChild($projectManager, $updateTask);

        $auth->addChild($user, $updateTask);

        $auth->addChild($admin, $viewAdminPage);
        $auth->addChild($admin, $projectManager);

        $auth->assign($admin, 7);

        // Add rule, based on UserExt->role === $user->role
        $UserRoleRule = new UserRoleRule();
        $auth->add($UserRoleRule);

    }

}
