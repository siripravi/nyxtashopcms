<?php

use yii\db\Migration;

class m231112_112322_create_table_nxt_value extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%value}}',
            [
                'id' => $this->primaryKey(),
                'feature_id' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_value_lang-feature_id', '{{%value}}', ['feature_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%value}}');
    }
}
