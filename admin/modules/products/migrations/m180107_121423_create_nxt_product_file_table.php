<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_file`.
 */
class m180107_121423_create_nxt_product_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_product_file', [
            'product_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_product_file', 'nxt_product_file', ['product_id', 'file_id']);

        $this->addForeignKey('fk-nxt_product_file-product_id', 'nxt_product_file', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_file-file_id', 'nxt_product_file', 'file_id', 'nxt_file', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_product_file-file_id', 'nxt_product_file');

        $this->dropForeignKey('fk-nxt_product_file-product_id', 'nxt_product_file');

        $this->dropPrimaryKey('pk-nxt_product_file', 'nxt_product_file');

        $this->dropTable('nxt_product_file');
    }
}
