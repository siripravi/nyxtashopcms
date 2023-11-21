<?php

use yii\db\Migration;

class m231112_112300_create_table_nxt_feature_lang extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%feature_lang}}',
            [
                'feature_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string()->notNull(),
                'after' => $this->string(32),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%feature_lang}}', ['feature_id', 'lang_id']);

        $this->createIndex('fk-nxt_feature_lang-lang_id', '{{%feature_lang}}', ['lang_id']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%feature_lang}}');
    }
}
