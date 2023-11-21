<?php

use yii\db\Migration;

class m231112_112325_create_table_nxt_variant_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%variant_image}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'image_id' => $this->integer()->notNull(),
                'enabled' => $this->integer()->notNull()->defaultValue('1'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_image}}', ['variant_id', 'image_id']);

        $this->addForeignKey(
            'fk-nxt_variant_image-image_id',
            '{{%variant_image}}',
            ['image_id'],
            '{{%image}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-nxt_variant_image-variant_id',
            '{{%variant_image}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%variant_image}}');
    }
}
