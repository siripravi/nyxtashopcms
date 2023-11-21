<?php

use yii\db\Migration;

class m231112_112250_create_table_nxt_category_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

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
        $this->dropTable('{{%category_lang}}');
    }
}
