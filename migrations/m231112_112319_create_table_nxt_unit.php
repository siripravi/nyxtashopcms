<?php

use yii\db\Migration;

class m231112_112319_create_table_nxt_unit extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%unit}}',
            [
                'id' => $this->primaryKey(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
        $this->createTable(
            '{{%unit_lang}}',
            [
                'unit_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%unit_lang}}', ['unit_id', 'lang_id']);

        $this->createIndex('fk-nxt_unit_lang-lang_id', '{{%unit_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%unit}}');
        $this->dropTable('{{%unit_lang}}');
    }
}
