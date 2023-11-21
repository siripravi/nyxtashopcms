<?php

use yii\db\Migration;

class m231121_051507_create_table_nxt_page_file extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_file}}',
            [
                'page_id' => $this->integer()->notNull(),
                'file_id' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%page_file}}', ['page_id', 'file_id']);

        $this->createIndex('fk-page_file-file_id', '{{%page_file}}', ['file_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_file}}');
    }
}
