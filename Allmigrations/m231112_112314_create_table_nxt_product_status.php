<?php

use yii\db\Migration;

class m231112_112314_create_table_nxt_product_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product_status}}',
            [
                'product_id' => $this->integer()->notNull(),
                'status_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_status}}', ['product_id', 'status_id']);

        $this->createIndex('fk-product_status-status_id', '{{%product_status}}', ['status_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_status}}');
    }
}
