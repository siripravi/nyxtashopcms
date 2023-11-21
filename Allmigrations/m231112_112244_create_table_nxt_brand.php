<?php

use yii\db\Migration;

class m231112_112244_create_table_nxt_brand extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%brand}}',
            [
                'id' => $this->primaryKey(),
                'image_id' => $this->integer(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_brand-image_id', '{{%brand}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%brand}}');
    }
}
