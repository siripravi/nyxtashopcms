<?php

use yii\db\Migration;

class m231112_112251_create_table_nxt_complect extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%complect}}',
            [
                'id' => $this->primaryKey(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%complect}}');
    }
}
