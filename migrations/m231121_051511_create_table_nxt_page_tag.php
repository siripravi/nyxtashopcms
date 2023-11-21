<?php

use yii\db\Migration;

class m231121_051511_create_table_nxt_page_tag extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%page_tag}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(128)->notNull(),
                'frequency' => $this->integer()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('frequency', '{{%page_tag}}', ['frequency']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%page_tag}}');
    }
}
