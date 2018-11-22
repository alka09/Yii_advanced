<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_image_to_tasks`.
 */
class m181108_101904_create_add_image_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'image');
    }
}
