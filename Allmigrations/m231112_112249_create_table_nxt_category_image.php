<?php

use yii\db\Migration;

class m231112_112249_create_table_nxt_category_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%category_image}}',
            [
                'category_id' => $this->integer()->notNull(),
                'image_id' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->integer()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%category_image}}', ['category_id', 'image_id']);

        $this->createIndex('fk-nxt_category_image-image_id', '{{%category_image}}', ['image_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%category_image}}');
    }
}
