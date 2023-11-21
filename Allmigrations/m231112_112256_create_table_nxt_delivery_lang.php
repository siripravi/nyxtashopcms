<?php

use yii\db\Migration;

class m231112_112256_create_table_nxt_delivery_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%delivery_lang}}',
            [
                'delivery_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'text' => $this->text(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%delivery_lang}}', ['delivery_id', 'lang_id']);

        $this->createIndex('fk-delivery_lang-lang_id', '{{%delivery_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%delivery_lang}}');
    }
}
