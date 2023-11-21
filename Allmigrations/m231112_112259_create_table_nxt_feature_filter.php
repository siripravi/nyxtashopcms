<?php

use yii\db\Migration;

class m231112_112259_create_table_nxt_feature_filter extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%feature_filter}}',
            [
                'feature_id' => $this->integer()->notNull(),
                'category_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%feature_filter}}', ['feature_id', 'category_id']);

        $this->createIndex('fk-nxt_feature_filter-category_id', '{{%feature_filter}}', ['category_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%feature_filter}}');
    }
}
