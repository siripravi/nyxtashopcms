<?php

use yii\db\Migration;

class m231112_112305_create_table_nxt_order_product extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%order_product}}',
            [
                'id' => $this->primaryKey(),
                'order_id' => $this->integer()->notNull(),
                'variant_id' => $this->integer(),
                'name' => $this->string(),
                'count' => $this->integer()->notNull(),
                'price' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('fk-order_product-variant_id', '{{%order_product}}', ['variant_id']);
        $this->createIndex('fk-order_product-order_id', '{{%order_product}}', ['order_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%order_product}}');
    }
}
