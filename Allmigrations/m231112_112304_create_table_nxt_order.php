<?php

use yii\db\Migration;

class m231112_112304_create_table_nxt_order extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%order}}',
            [
                'id' => $this->primaryKey(),
                'buyer_id' => $this->integer()->notNull(),
                'amount' => $this->integer()->notNull(),
                'text' => $this->text(),
                'created_at' => $this->integer()->notNull(),
                'status' => $this->smallInteger()->notNull()->defaultValue('1'),
                'phone' => $this->string(12)->notNull(),
                'email' => $this->string(),
                'delivery' => $this->string(),
                'delivery_id' => $this->integer(),
                'payment_id' => $this->integer(),
                'comment' => $this->text(),
            ],
            $tableOptions
        );

        $this->createIndex('fk-order-payment_id', '{{%order}}', ['payment_id']);
        $this->createIndex('fk-order-delivery_id', '{{%order}}', ['delivery_id']);
        $this->createIndex('fk-order-buyer_id', '{{%order}}', ['buyer_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
