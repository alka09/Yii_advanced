<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m181016_162540_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'date' => $this->dateTime(),
            'description' => $this->string(1024)->notNull(),
            'user_id' => $this->integer(),
            'create_at' => $this->DATETIME(),
            'updated_at' => $this->DATETIME(),
            'image' => $this->string(),
        ]);
        $this->addForeignKey('fk_task_user_id', 'tasks', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
