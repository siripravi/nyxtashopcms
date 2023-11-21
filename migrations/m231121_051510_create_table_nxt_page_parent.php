<?php

use yii\db\Migration;

class m231121_051510_create_table_nxt_page_parent extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_parent}}',
            [
                'page_id' => $this->integer()->notNull(),
                'parent_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%page_parent}}', ['page_id', 'parent_id']);

        $this->createIndex('fk-parent_id', '{{%page_parent}}', ['parent_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_parent}}');
    }
}
