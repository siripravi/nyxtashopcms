<?php

use yii\db\Migration;

class m231112_112313_create_table_nxt_product_option extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%product_option}}',
            [
                'product_id' => $this->integer()->notNull(),
                'option_id' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_option}}', ['product_id', 'option_id']);

        $this->createIndex('fk-nxt_product_option-option_id', '{{%product_option}}', ['option_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_option}}');
    }
}
