<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_status`.
 */
class m170420_192738_create_nxt_product_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_product_status', [
            'product_id' => $this->integer()->notNull(),
            'status_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_product_status', 'nxt_product_status', ['product_id', 'status_id']);

        $this->addForeignKey('fk-nxt_product_status-product_id', 'nxt_product_status', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_status-status_id', 'nxt_product_status', 'status_id', 'nxt_status', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_product_status-status_id', 'nxt_product_status');

        $this->dropForeignKey('fk-nxt_product_status-product_id', 'nxt_product_status');

        $this->dropPrimaryKey('pk-nxt_product_status', 'nxt_product_status');

        $this->dropTable('nxt_product_status');
    }
}
