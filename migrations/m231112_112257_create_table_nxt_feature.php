<?php

use yii\db\Migration;

class m231112_112257_create_table_nxt_feature extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%feature}}',
            [
                'id' => $this->primaryKey(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%feature_category}}',
            [
                'feature_id' => $this->integer()->notNull(),
                'category_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%feature_category}}', ['feature_id', 'category_id']);

        $this->createIndex('fk-nxt_feature_category-category_id', '{{%feature_category}}', ['category_id']);
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

        $this->createTable(
            '{{%feature_lang}}',
            [
                'feature_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'after' => $this->string(32),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%feature_lang}}', ['feature_id', 'lang_id']);

        $this->createIndex('fk-nxt_feature_lang-lang_id', '{{%feature_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%feature}}');
        $this->dropTable('{{%feature_category}}');
        $this->dropTable('{{%feature_filter}}');
        $this->dropTable('{{%feature_lang}}');
    }
}
