<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m181201_110655_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'description' => $this->text()->notNull(),
            'date' => $this->dateTime(),
            'responsible_id' => $this->integer(),
            'initiator_id'=> $this->integer(),
            'project_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this ->addForeignKey('fk_task_users_responsible_id', "tasks", 'responsible_id', 'user', 'id');
        $this ->addForeignKey('fk_task_users_initiator', "tasks", 'initiator_id', 'user', 'id');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('task');
    }
}
