<?php

use yii\db\Migration;

class m231112_112247_create_table_nxt_buyer_addresses extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%buyer_addresses}}',
            [
                'id' => $this->primaryKey(),
                'buyer_id' => $this->integer()->notNull(),
                'address' => $this->string()->notNull(),
                'city' => $this->string()->notNull(),
                'state' => $this->string()->notNull(),
                'country' => $this->string()->notNull(),
                'zipcode' => $this->string(),
            ],
            $tableOptions
        );

        $this->createIndex('idx-buyer_addresses-buyer_id', '{{%buyer_addresses}}', ['buyer_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%buyer_addresses}}');
    }
}
