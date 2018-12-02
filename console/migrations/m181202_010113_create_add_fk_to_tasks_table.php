<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_fk_to_tasks`.
 */
class m181202_010113_create_add_fk_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_task_project_id', 'tasks', 'project_id', 'project', 'id');
    }
        /**
         * {@inheritdoc}
         */
        public function safeDown()
    {
        echo "m181201_141122_add_key_task_project cannot be reverted.\n";
        return false;
    }
}
