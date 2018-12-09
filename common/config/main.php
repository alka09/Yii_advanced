<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'bootstrap' => ['CreateProjectComponent'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'CreateProjectComponent' => [
            'class' => \common\components\CreateProjectComponent::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache' //Включаем кеширование
        ],
        'cache' => [
            'class' => \common\components\CreateProjectComponent::class,
        ],
    ],
];
