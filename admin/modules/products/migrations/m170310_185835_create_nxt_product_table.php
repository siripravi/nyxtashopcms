<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170310_185835_create_nxt_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_product', [
            'id' => $this->primaryKey(),
            'slug' => $this->string()->notNull(),
            'brand_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'price_from' => $this->integer()->notNull()->defaultValue(0),
            'view' => $this->string(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_product_lang', [
            'product_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'h1' => $this->string()->notNull(),
            'keywords' => $this->string()->notNull()->defaultValue(''),
            'description' => $this->text(),
            'text' => $this->text(),
        ], $tableOptions);

        $this->createTable('nxt_product_category', [
            'product_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_product_lang', 'nxt_product_lang', ['product_id', 'lang_id']);

        $this->addPrimaryKey('pk-nxt_product_category', 'nxt_product_category', ['product_id', 'category_id']);

        $this->addForeignKey('fk-nxt_product_category-product_id', 'nxt_product_category', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_category-category_id', 'nxt_product_category', 'category_id', 'nxt_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product-brand_id', 'nxt_product', 'brand_id', 'nxt_brand', 'id', 'SET NULL');

        $this->addForeignKey('fk-nxt_product_lang-product_id', 'nxt_product_lang', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_product_lang-lang_id', 'nxt_product_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_product_lang-lang_id', 'nxt_product_lang');

        $this->dropForeignKey('fk-nxt_product_lang-product_id', 'nxt_product_lang');

        $this->dropForeignKey('fk-nxt_product-brand_id', 'nxt_product');

        $this->dropForeignKey('fk-nxt_product_category-category_id', 'nxt_product_category');

        $this->dropForeignKey('fk-nxt_product_category-product_id', 'nxt_product_category');

        $this->dropPrimaryKey('pk-nxt_product_category', 'nxt_product_category');

        $this->dropPrimaryKey('pk-nxt_product_lang', 'nxt_product_lang');

        $this->dropTable('nxt_product_category');

        $this->dropTable('nxt_product_lang');

        $this->dropTable('nxt_product');
    }
}
