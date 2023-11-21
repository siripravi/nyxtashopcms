<?php

use yii\db\Migration;

class m231112_112306_create_table_nxt_payment extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%payment}}',
            [
                'id' => $this->primaryKey(),
                'type' => $this->integer()->notNull()->defaultValue('1'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
        $this->createTable(
            '{{%payment_lang}}',
            [
                'payment_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'text' => $this->text(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%payment_lang}}', ['payment_id', 'lang_id']);

        $this->createIndex('fk-payment_lang-lang_id', '{{%payment_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
        $this->dropTable('{{%payment_lang}}');
    }
}
