<?php

use yii\db\Migration;

class m231112_112303_create_table_nxt_language extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%language}}',
            [
                'id' => $this->string(3)->notNull()->append('PRIMARY KEY'),
                'name' => $this->string(31)->notNull(),
                'position' => $this->smallInteger()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
