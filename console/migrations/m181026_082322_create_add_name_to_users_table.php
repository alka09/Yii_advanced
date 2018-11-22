<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_name_to_users`.
 */
class m181026_082322_create_add_name_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'name', $this->string(128));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'name');
    }
}
