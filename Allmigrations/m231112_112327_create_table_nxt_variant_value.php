<?php

use yii\db\Migration;

class m231112_112327_create_table_nxt_variant_value extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%variant_value}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'value_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_value}}', ['variant_id', 'value_id']);

        $this->addForeignKey(
            'fk-nxt_variant_value-value_id',
            '{{%variant_value}}',
            ['value_id'],
            '{{%value}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-nxt_variant_value-variant_id',
            '{{%variant_value}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%variant_value}}');
    }
}
