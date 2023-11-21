<?php

use yii\db\Migration;

/**
 * Class m191115_135446_add_user_id_to_file_table
 */
class m191115_135446_add_user_id_to_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('nxt_file', 'user_id', $this->integer());

        $this->addForeignKey('fk-user_id-file', 'nxt_file', 'user_id', '{{%user}}', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user_id-file', 'nxt_file');

        $this->dropColumn('nxt_file', 'user_id');
    }
}
