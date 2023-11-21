<?php

use yii\db\Migration;

class m231112_112315_create_table_nxt_setting extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%setting}}',
            [
                'id' => $this->string()->notNull()->append('PRIMARY KEY'),
            ],
            $tableOptions
        );

        $this->createTable(
            '{{%setting_lang}}',
            [
                'setting_id' => $this->string()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'value' => $this->text()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%setting_lang}}', ['setting_id', 'lang_id']);

        $this->createIndex('fk-setting_lang-lang_id', '{{%setting_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
        $this->dropTable('{{%setting_lang}}');
    }
}
