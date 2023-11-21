<?php

use yii\db\Migration;

class m170402_155313_create_nxt_many_to_many_product_complect extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->dropForeignKey('fk-nxt_complect-product_id', 'nxt_complect');

        $this->dropColumn('nxt_complect', 'product_id');

        $this->createTable('nxt_product_complect', [
            'product_id' => $this->integer()->notNull(),
            'complect_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_product_complect', 'nxt_product_complect', ['product_id', 'complect_id']);

        $this->addForeignKey('fk-nxt_product_complect-product_id', 'nxt_product_complect', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_complect-complect_id', 'nxt_product_complect', 'complect_id', 'nxt_complect', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-nxt_product_complect-complect_id', 'nxt_product_complect');

        $this->dropForeignKey('fk-nxt_product_complect-product_id', 'nxt_product_complect');

        $this->dropPrimaryKey('pk-nxt_product_complect', 'nxt_product_complect');

        $this->dropTable('nxt_product_complect');

        $this->addColumn('nxt_complect', 'product_id', 'integer');

        $this->addForeignKey('fk-nxt_complect-product_id', 'nxt_complect', 'product_id', 'nxt_product', 'id', 'CASCADE');
    }
}
