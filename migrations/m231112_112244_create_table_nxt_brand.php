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

        $this->createTable(
            '{{%brand_lang}}',
            [
                'brand_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%brand_lang}}', ['brand_id', 'lang_id']);

        $this->createIndex('fk-nxt_brand_lang-lang_id', '{{%brand_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%brand}}');
        $this->dropTable('{{%brand_lang}}');
    }
}
