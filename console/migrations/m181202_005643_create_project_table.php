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
            'name' => $this->string(128),
            'description' => $this->text(),
            'creator' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue('0'),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
        $this->addForeignKey('fk_creator_id', 'project', 'creator', 'user', 'id');

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
