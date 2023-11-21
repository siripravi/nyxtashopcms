<?php

use yii\db\Migration;

class m231112_112326_create_table_nxt_variant_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%variant_lang}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_lang}}', ['variant_id', 'lang_id']);

        $this->addForeignKey(
            'fk-nxt_variant_lang-lang_id',
            '{{%variant_lang}}',
            ['lang_id'],
            '{{%language}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-nxt_variant_lang-variant_id',
            '{{%variant_lang}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%variant_lang}}');
    }
}
