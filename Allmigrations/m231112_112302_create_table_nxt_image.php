<?php

use yii\db\Migration;

class m231112_112302_create_table_nxt_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

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
        $this->dropTable('{{%image}}');
    }
}
