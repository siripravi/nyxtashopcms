<?php

use yii\db\Migration;

class m231112_112321_create_table_nxt_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%user}}',
            [
                'id' => $this->primaryKey(),
                'username' => $this->string()->notNull(),
                'fullname' => $this->string(),
                'avatar' => $this->string(),
                'auth_key' => $this->string(32)->notNull(),
                'password_hash' => $this->string()->notNull(),
                'password_reset_token' => $this->string()->notNull(),
                'email' => $this->string(),
                'github' => $this->string(),
                'twitter' => $this->string(),
                'facebook' => $this->string(),
                'status' => $this->smallInteger()->notNull()->defaultValue('10'),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'notify_about_comment_on_email' => $this->boolean()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->createIndex('username', '{{%user}}', ['username'], true);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
