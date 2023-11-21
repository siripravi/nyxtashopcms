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
        $this->createTable(
            '{{%product_complect}}',
            [
                'product_id' => $this->integer()->notNull(),
                'complect_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_complect}}', ['product_id', 'complect_id']);

        $this->createIndex('fk-nxt_product_complect-complect_id', '{{%product_complect}}', ['complect_id']);
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
        $this->createTable(
            '{{%product_lang}}',
            [
                'product_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'h1' => $this->string()->notNull(),
                'keywords' => $this->string()->notNull()->defaultValue(''),
                'description' => $this->text(),
                'text' => $this->text(),
                'text_tips' => $this->text(),
                'text_features' => $this->text(),
                'text_process' => $this->text(),
                'text_use' => $this->text(),
                'text_storage' => $this->text(),
                'text_short' => $this->text(),
                'text_top' => $this->text(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%product_lang}}', ['product_id', 'lang_id']);

        $this->createIndex('fk-nxt_product_lang-lang_id', '{{%product_lang}}', ['lang_id']);
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
        $this->dropTable('{{%product}}');
        $this->dropTable('{{%product_category}}');
        $this->dropTable('{{%product_complect}}');
        $this->dropTable('{{%product_file}}');
        $this->dropTable('{{%product_lang}}');
        $this->dropTable('{{%product_option}}');
        $this->dropTable('{{%product_status}}');
    }
}
