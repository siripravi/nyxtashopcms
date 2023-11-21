<?php

use yii\db\Migration;

class m231112_112311_create_table_nxt_product_file extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product_file}}',
            [
                'product_id' => $this->integer()->notNull(),
                'file_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_file}}', ['product_id', 'file_id']);

        $this->createIndex('fk-nxt_product_file-file_id', '{{%product_file}}', ['file_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_file}}');
    }
}
