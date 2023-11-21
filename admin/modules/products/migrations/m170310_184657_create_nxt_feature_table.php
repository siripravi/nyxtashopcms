<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature`.
 */
class m170310_184657_create_nxt_feature_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_feature', [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_feature_lang', [
            'feature_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'after' => $this->string(32),
        ], $tableOptions);

        $this->createTable('nxt_feature_category', [
            'feature_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_feature_lang', 'nxt_feature_lang', ['feature_id', 'lang_id']);

        $this->addPrimaryKey('pk-nxt_feature_category', 'nxt_feature_category', ['feature_id', 'category_id']);

        $this->addForeignKey('fk-nxt_feature_category-feature_id', 'nxt_feature_category', 'feature_id', 'nxt_feature', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_feature_category-category_id', 'nxt_feature_category', 'category_id', 'nxt_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_feature_lang-feature_id', 'nxt_feature_lang', 'feature_id', 'nxt_feature', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_feature_lang-lang_id', 'nxt_feature_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_feature_lang-lang_id', 'nxt_feature_lang');

        $this->dropForeignKey('fk-nxt_feature_lang-feature_id', 'nxt_feature_lang');

        $this->dropForeignKey('fk-nxt_feature_category-category_id', 'nxt_feature_category');

        $this->dropForeignKey('fk-nxt_feature_category-feature_id', 'nxt_feature_category');

        $this->dropPrimaryKey('pk-nxt_feature_category', 'nxt_feature_category');

        $this->dropPrimaryKey('pk-nxt_feature_lang', 'nxt_feature_lang');

        $this->dropTable('nxt_feature_category');

        $this->dropTable('nxt_feature_lang');

        $this->dropTable('nxt_feature');
    }
}
