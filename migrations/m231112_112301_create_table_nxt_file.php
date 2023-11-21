<?php

use yii\db\Migration;

class m231112_112301_create_table_nxt_file extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%file}}',
            [
                'id' => $this->primaryKey(),
                'path' => $this->string(10)->notNull(),
                'hash' => $this->string(32)->notNull(),
                'extension' => $this->string(10)->notNull(),
                'type' => $this->string()->notNull(),
                'size' => $this->integer()->notNull(),
                'name' => $this->string()->notNull(),
                'enabled' => $this->boolean()->notNull()->defaultValue('0'),
                'created_at' => $this->integer()->notNull(),
                'user_id' => $this->integer(),
                'group' => $this->string(32),
            ],
            $tableOptions
        );

        $this->createIndex('fk-user_id-file', '{{%file}}', ['user_id']);
        $this->createIndex('idx-hash', '{{%file}}', ['hash']);
        $this->createTable(
            '{{%image}}',
            [
                'id' => $this->primaryKey(),
                'file_id' => $this->integer()->notNull(),
                'method' => $this->string(10),
                'name' => $this->string()->notNull(),
                'alt' => $this->string(),
                'rotate' => $this->smallInteger(),
                'mirror' => $this->boolean()->defaultValue('0'),
                'width' => $this->integer()->notNull(),
                'height' => $this->integer()->notNull(),
                'x' => $this->integer(),
                'y' => $this->integer(),
                'zoom' => $this->smallInteger(),
                'watermark' => $this->boolean(),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_image-file_id', '{{%image}}', ['file_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%file}}');
        $this->dropTable('{{%image}}');
    }
}
