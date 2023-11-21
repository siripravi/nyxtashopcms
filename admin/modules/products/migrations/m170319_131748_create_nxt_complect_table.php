<?php

use yii\db\Migration;

/**
 * Handles the creation of table `complect`.
 */
class m170319_131748_create_nxt_complect_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_complect', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('nxt_complect_lang', [
            'complect_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_complect_lang', 'nxt_complect_lang', ['complect_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_complect_lang-complect_id', 'nxt_complect_lang', 'complect_id', 'nxt_complect', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_complect_lang-lang_id', 'nxt_complect_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', );

        $this->addForeignKey('fk-nxt_complect-product_id', 'nxt_complect', 'product_id', 'nxt_product', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_complect-product_id', 'nxt_complect');

        $this->dropForeignKey('fk-nxt_complect_lang-lang_id', 'nxt_complect_lang');

        $this->dropForeignKey('fk-nxt_complect_lang-complect_id', 'nxt_complect_lang');

        $this->dropPrimaryKey('pk-nxt_complect_lang', 'nxt_complect_lang');

        $this->dropTable('nxt_complect_lang');

        $this->dropTable('nxt_complect');
    }
}
