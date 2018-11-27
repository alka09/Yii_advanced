<?php

use yii\db\Migration;

/**
 * Class m181125_073726_create
 */
class m181125_073726_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role_id', $this->integer());

        $this->addForeignKey('fk_user_roles', 'user', 'role_id', 'roles', 'id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role_id');
    }


}
