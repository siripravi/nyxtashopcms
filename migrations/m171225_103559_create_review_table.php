<?php

use yii\db\Migration;

/**
 * Handles the creation of table `review`.
 */
class m171225_103559_create_review_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%review}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text(),
            'answer' => $this->text(),
            'email' => $this->string(),
            'rating' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->addColumn('{{%review}}', 'product_id', $this->integer());

        $this->addForeignKey('fk-review-product_id', '{{%review}}', 'product_id', '{{%product}}', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-review-product_id', '{{%review}}');
        $this->dropTable('{{%review}}');
    }
}
