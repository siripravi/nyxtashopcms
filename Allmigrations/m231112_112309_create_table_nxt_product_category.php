<?php

use yii\db\Migration;

class m231112_112309_create_table_nxt_product_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product_category}}',
            [
                'product_id' => $this->integer()->notNull(),
                'category_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_category}}', ['product_id', 'category_id']);

        $this->createIndex('fk-nxt_product_category-category_id', '{{%product_category}}', ['category_id']);
        
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_category}}');
    }
}
