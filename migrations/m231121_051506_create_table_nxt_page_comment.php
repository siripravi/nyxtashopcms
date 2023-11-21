<?php

use yii\db\Migration;

class m231121_051506_create_table_nxt_page_comment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_comment}}',
            [
                'id' => $this->primaryKey(),
                'post_id' => $this->integer()->notNull(),
                'content' => $this->text()->notNull(),
                'author' => $this->string(128)->notNull(),
                'email' => $this->string(128)->notNull(),
                'url' => $this->string(128),
                'status' => $this->integer()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('created_at', '{{%page_comment}}', ['created_at']);
        $this->createIndex('status', '{{%page_comment}}', ['status']);
        $this->createIndex('post_id', '{{%page_comment}}', ['post_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_comment}}');
    }
}
