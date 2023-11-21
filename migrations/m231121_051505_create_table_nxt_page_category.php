<?php

use yii\db\Migration;

class m231121_051505_create_table_nxt_page_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_category}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer()->notNull()->defaultValue('0'),
                'title' => $this->string()->notNull(),
                'slug' => $this->string(128)->notNull(),
                'banner' => $this->string(),
                'is_nav' => $this->integer()->notNull()->defaultValue('1'),
                'sort_order' => $this->integer()->notNull()->defaultValue('50'),
                'page_size' => $this->integer()->notNull()->defaultValue('10'),
                'template' => $this->string()->notNull()->defaultValue('post'),
                'redirect_url' => $this->string(),
                'position' => $this->integer()->notNull(),
                'status' => $this->integer()->notNull()->defaultValue('1'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('created_at', '{{%page_category}}', ['created_at']);
        $this->createIndex('status', '{{%page_category}}', ['status']);
        $this->createIndex('sort_order', '{{%page_category}}', ['sort_order']);
        $this->createIndex('is_nav', '{{%page_category}}', ['is_nav']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_category}}');
    }
}
