<?php

use yii\db\Migration;

class m231112_112315_create_table_nxt_setting extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%setting}}',
            [
                'id' => $this->string()->notNull()->append('PRIMARY KEY'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
