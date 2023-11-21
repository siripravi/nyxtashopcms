<?php

use yii\db\Migration;

class m231112_112317_create_table_nxt_status extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%status}}',
            [
                'id' => $this->primaryKey(),
                'color' => $this->string(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
        $this->createTable(
            '{{%status_lang}}',
            [
                'status_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%status_lang}}', ['status_id', 'lang_id']);

        $this->createIndex('fk-product_status_lang-lang_id', '{{%status_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%status}}');
        $this->dropTable('{{%status_lang}}');
    }
}
