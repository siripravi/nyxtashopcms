<?php

use yii\db\Migration;

class m231112_112246_create_table_nxt_buyer extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%buyer}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'phone' => $this->string(12)->notNull(),
                'email' => $this->string(),
                'created_at' => $this->integer()->notNull(),
                'entity' => $this->boolean(),
                'delivery' => $this->string(),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%buyer}}');
    }
}
