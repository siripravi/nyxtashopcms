<?php

use yii\db\Migration;

class m231121_051508_create_table_nxt_page_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_image}}',
            [
                'page_id' => $this->integer()->notNull(),
                'image_id' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%page_image}}', ['page_id', 'image_id']);

        $this->createIndex('fk-page_image-image_id', '{{%page_image}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_image}}');
    }
}
