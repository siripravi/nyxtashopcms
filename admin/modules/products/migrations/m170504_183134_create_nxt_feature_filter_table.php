<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feature_filter`.
 */
class m170504_183134_create_nxt_feature_filter_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_feature_filter', [
            'feature_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_feature_filter', 'nxt_feature_filter', ['feature_id', 'category_id']);

        $this->addForeignKey('fk-nxt_feature_filter-feature_id', 'nxt_feature_filter', 'feature_id', 'nxt_feature', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_feature_filter-category_id', 'nxt_feature_filter', 'category_id', 'nxt_category', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_feature_filter-category_id', 'nxt_feature_filter');

        $this->dropForeignKey('fk-nxt_feature_filter-feature_id', 'nxt_feature_filter');

        $this->dropPrimaryKey('pk-nxt_feature_filter', 'nxt_feature_filter');

        $this->dropTable('nxt_feature_filter');
    }
}
