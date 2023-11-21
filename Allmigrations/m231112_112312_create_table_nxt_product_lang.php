<?php

use yii\db\Migration;

class m231112_112312_create_table_nxt_product_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

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
    }

    public function safeDown()
    {
        $this->dropTable('{{%product_lang}}');
    }
}
