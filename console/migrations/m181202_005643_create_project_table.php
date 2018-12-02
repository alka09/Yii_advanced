<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m181202_005643_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)
        ]);

        $this->createIndex('idx_project_name', 'project', 'name');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('project');
    }
}
