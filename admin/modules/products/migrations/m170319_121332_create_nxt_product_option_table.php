<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_option`.
 */
class m170319_121332_create_nxt_product_option_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_product_option', [
            'product_id' => $this->integer()->notNull(),
            'option_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_product_option', 'nxt_product_option', ['product_id', 'option_id']);

        $this->addForeignKey('fk-nxt_product_option-product_id', 'nxt_product_option', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_option-option_id', 'nxt_product_option', 'option_id', 'nxt_product', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_product_option-option_id', 'nxt_product_option');

        $this->dropForeignKey('fk-nxt_product_option-product_id', 'nxt_product_option');

        $this->dropPrimaryKey('pk-nxt_product_option', 'nxt_product_option');

        $this->dropTable('nxt_product_option');
    }
}
