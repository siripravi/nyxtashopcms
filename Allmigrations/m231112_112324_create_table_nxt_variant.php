<?php

use yii\db\Migration;

class m231112_112324_create_table_nxt_variant extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%variant}}',
            [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'code' => $this->string(),
                'price' => $this->decimal(9, 2),
                'price_old' => $this->decimal(9, 2),
                'currency_id' => $this->integer()->notNull(),
                'unit_id' => $this->integer()->notNull(),
                'available' => $this->integer()->notNull()->defaultValue('1'),
                'image_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_variant-unit_id', '{{%variant}}', ['unit_id']);
        $this->createIndex('fk-nxt_variant-currency_id', '{{%variant}}', ['currency_id']);
        $this->createIndex('fk-nxt_variant-product_id', '{{%variant}}', ['product_id']);
        $this->createIndex('idx-nxt_variant-image_id', '{{%variant}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%variant}}');
    }
}
