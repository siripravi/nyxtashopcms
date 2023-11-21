<?php

use yii\db\Migration;

class m231112_112310_create_table_nxt_product_complect extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product_complect}}',
            [
                'product_id' => $this->integer()->notNull(),
                'complect_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_complect}}', ['product_id', 'complect_id']);

        $this->createIndex('fk-nxt_product_complect-complect_id', '{{%product_complect}}', ['complect_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_complect}}');
    }
}
