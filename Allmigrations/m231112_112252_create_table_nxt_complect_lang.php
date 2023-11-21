<?php

use yii\db\Migration;

class m231112_112252_create_table_nxt_complect_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%complect_lang}}',
            [
                'complect_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%complect_lang}}', ['complect_id', 'lang_id']);

        $this->createIndex('fk-nxt_complect_lang-lang_id', '{{%complect_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%complect_lang}}');
    }
}
