<?php

use yii\db\Migration;

/**
 * Class m181125_083420_create
 */
class m181125_083420_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_role_id', 'user', 'role_id', 'roles', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181125_083420_create cannot be reverted.\n";
        return false;
    }


}
