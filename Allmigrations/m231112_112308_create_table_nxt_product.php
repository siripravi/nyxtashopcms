<?php

use yii\db\Migration;

class m231112_112308_create_table_nxt_product extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product}}',
            [
                'id' => $this->primaryKey(),
                'slug' => $this->string()->notNull(),
                'brand_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'price_from' => $this->integer()->notNull()->defaultValue('0'),
                'view' => $this->string(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_product-brand_id', '{{%product}}', ['brand_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
