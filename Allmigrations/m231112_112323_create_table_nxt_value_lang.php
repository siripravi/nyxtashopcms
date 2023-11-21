<?php

use yii\db\Migration;

class m231112_112323_create_table_nxt_value_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%value_lang}}',
            [
                'value_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%value_lang}}', ['value_id', 'lang_id']);

        $this->createIndex('fk-nxt_value_lang-lang_id', '{{%value_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%value_lang}}');
    }
}
