<?php

use yii\db\Migration;

class m231121_051504_create_table_nxt_page extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(225)->notNull(),
                'slug' => $this->string()->notNull(),
                'name' => $this->string()->notNull(),
                'keywords' => $this->string()->notNull(),
                'description' => $this->text()->notNull(),
                'text' => $this->text()->notNull(),
                'short' => $this->text()->notNull(),
                'category_id' => $this->integer()->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
                'image_id' => $this->integer(),
                'status' => $this->integer()->notNull(),
                'type' => $this->boolean()->notNull()->defaultValue('0'),
                'tags' => $this->string()->notNull(),
                'banner' => $this->string()->notNull(),
                'click' => $this->integer()->notNull(),
                'user_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->createIndex('Fk_user_posted', '{{%page}}', ['user_id']);
        $this->createIndex('FK_page_category', '{{%page}}', ['category_id']);
        $this->createIndex('idx-page-image_id', '{{%page}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page}}');
    }
}
