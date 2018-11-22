<?php

use yii\db\Migration;

/**
 * Class m181024_232825_add_email_to_users_table
 */
class m181024_232825_add_email_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'email', $this->string(128));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'email');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181024_232825_add_email_to_users_table cannot be reverted.\n";

        return false;
    }
    */
}
