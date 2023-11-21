<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m170310_185023_create_nxt_product_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_status', [
            'id' => $this->primaryKey(),
            'color' => $this->string(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_status_lang', [
            'status_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_status_lang', 'nxt_status_lang', ['status_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_status_lang-status_id', 'nxt_status_lang', 'status_id', 'status', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_status_lang-lang_id', 'nxt_status_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_status_lang-lang_id', 'nxt_status_lang');

        $this->dropForeignKey('fk-nxt_status_lang-status_id', 'nxt_status_lang');

        $this->dropPrimaryKey('pk-nxt_status_lang', 'nxt_status_lang');

        $this->dropTable('nxt_status_lang');
        
        $this->dropTable('nxt_status');
    }
}
