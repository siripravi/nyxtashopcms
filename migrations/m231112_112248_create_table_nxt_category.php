<?php

use yii\db\Migration;

class m231112_112248_create_table_nxt_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%category}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer(),
                'slug' => $this->string()->notNull(),
                'image_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'main' => $this->boolean()->notNull()->defaultValue('0'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_category-parent_id', '{{%category}}', ['parent_id']);
        $this->createIndex('fk-nxt_category-image_id', '{{%category}}', ['image_id']);

        $this->createTable(
            '{{%category_image}}',
            [
                'category_id' => $this->integer()->notNull(),
                'image_id' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->integer()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%category_image}}', ['category_id', 'image_id']);

        $this->createIndex('fk-nxt_category_image-image_id', '{{%category_image}}', ['image_id']);

        $this->createTable(
            '{{%category_lang}}',
            [
                'category_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'h1' => $this->string()->notNull(),
                'keywords' => $this->string(),
                'description' => $this->text(),
                'text' => $this->text(),
                'seo' => $this->text(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%category_lang}}', ['category_id', 'lang_id']);

        $this->createIndex('fk-nxt_category_lang-lang_id', '{{%category_lang}}', ['lang_id']);

    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%category_image}}');
        $this->dropTable('{{%category_lang}}');
    }
}
