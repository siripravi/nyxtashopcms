<?php

use yii\db\Migration;

class m231112_112253_create_table_nxt_currency extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%currency}}',
            [
                'id' => $this->primaryKey(),
                'code' => $this->string(3)->notNull(),
                'rate' => $this->decimal(8, 4)->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'before' => $this->string(20)->notNull(),
                'after' => $this->string(20)->notNull(),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
        $this->createTable(
            '{{%currency_lang}}',
            [
                'currency_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'before' => $this->string(),
                'after' => $this->string(),
            ],
            $tableOptions
        );
        
        $this->addPrimaryKey('PRIMARYKEY', '{{%currency_lang}}', ['currency_id', 'lang_id']);

        $this->createIndex('fk-nxt_currency_lang-lang_id', '{{%currency_lang}}', ['lang_id']);

        
    }

    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
        $this->dropTable('{{%currency_lang}}');
    }
}
