<?php

use yii\db\Migration;

/**
 * Handles the creation of table `variant`.
 */
class m170310_191734_create_nxt_variant_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_variant', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'code' => $this->string(),
            'price' => $this->integer(),
            'price_old' => $this->integer(),
            'currency_id' => $this->integer()->notNull(),
            'unit_id' => $this->integer()->notNull(),
            'available' => $this->integer(),
            'image_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_variant_lang', [
            'variant_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string(),
        ], $tableOptions);

        $this->createTable('nxt_variant_value', [
            'variant_id' => $this->integer()->notNull(),
            'value_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-nxt_variant-image_id','nxt_variant', 'image_id');

        $this->addPrimaryKey('pk-nxt_variant_lang', 'nxt_variant_lang', ['variant_id', 'lang_id']);

        $this->addPrimaryKey('pk-nxt_variant_value', 'nxt_variant_value', ['variant_id', 'value_id']);

        $this->addForeignKey('fk-nxt_variant_value-variant_id', 'nxt_variant_value', 'variant_id', 'nxt_variant', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_variant_value-value_id', 'nxt_variant_value', 'value_id', 'nxt_value', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_variant-product_id', 'nxt_variant', 'product_id', 'nxt_product', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_variant-currency_id', 'nxt_variant', 'currency_id', 'nxt_currency', 'id');

        $this->addForeignKey('fk-nxt_variant-unit_id', 'nxt_variant', 'unit_id', 'nxt_unit', 'id');

        $this->addForeignKey('fk-nxt_variant_lang-variant_id', 'nxt_variant_lang', 'variant_id', 'nxt_variant', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_variant_lang-lang_id', 'nxt_variant_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', );

        $this->addForeignKey('fk-nxt_variant-image_id', 'nxt_variant', 'image_id', 'nxt_image', 'id', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_variant-image_id', 'nxt_variant');

        $this->dropForeignKey('fk-nxt_variant_lang-lang_id', 'nxt_variant_lang');

        $this->dropForeignKey('fk-nxt_variant_lang-variant_id', 'nxt_variant_lang');

        $this->dropForeignKey('fk-nxt_variant-unit_id', 'nxt_variant');

        $this->dropForeignKey('fk-nxt_variant-currency_id', 'nxt_variant');

        $this->dropForeignKey('fk-nxt_variant-product_id', 'nxt_variant');

        $this->dropForeignKey('fk-nxt_variant_value-value_id', 'nxt_variant_value');

        $this->dropForeignKey('fk-nxt_variant_value-variant_id', 'nxt_variant_value');

        $this->dropPrimaryKey('pk-nxt_variant_value', 'nxt_variant_value');

        $this->dropPrimaryKey('pk-nxt_variant_lang', 'nxt_variant_lang');

        $this->dropIndex('idx-nxt_variant-image_id', 'nxt_variant');

        $this->dropTable('nxt_variant_value');

        $this->dropTable('nxt_variant_lang');

        $this->dropTable('nxt_variant');
    }
}
