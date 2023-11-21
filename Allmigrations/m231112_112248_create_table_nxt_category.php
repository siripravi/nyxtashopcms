<?php

use yii\db\Migration;

class m231112_112248_create_table_nxt_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%category}}',
            [
                'id' => $this->primaryKey(),
                'parent_id' => $this->integer(),
                'slug' => $this->string()->notNull(),
                'image_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'main' => $this->boolean()->notNull()->defaultValue('0'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_category-parent_id', '{{%category}}', ['parent_id']);
        $this->createIndex('fk-nxt_category-image_id', '{{%category}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
