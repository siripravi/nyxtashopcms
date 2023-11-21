<?php

use yii\db\Migration;

class m231121_051509_create_table_nxt_page_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_lang}}',
            [
                'page_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'title' => $this->string()->notNull(),
                'keywords' => $this->string(),
                'description' => $this->text(),
                'text' => $this->text(),
                'short' => $this->text(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%page_lang}}', ['page_id', 'lang_id']);

        $this->createIndex('fk-page_lang-lang_id', '{{%page_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_lang}}');
    }
}
