<?php

use yii\db\Migration;

class m231112_112255_create_table_nxt_delivery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%delivery}}',
            [
                'id' => $this->primaryKey(),
                'type' => $this->integer()->notNull()->defaultValue('1'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%delivery}}');
    }
}
