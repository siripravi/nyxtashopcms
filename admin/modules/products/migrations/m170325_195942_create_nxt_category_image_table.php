<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_image`.
 */
class m170325_195942_create_nxt_category_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_category_image', [
            'category_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->integer()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_category_image', 'nxt_category_image', ['category_id', 'image_id']);
          
        $this->addForeignKey('fk-nxt_category_image-category_id', 'nxt_category_image', 'category_id', 'nxt_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_category_image-image_id', 'nxt_category_image', 'image_id', 'nxt_image', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_category_image-image_id', 'nxt_category_image');

        $this->dropForeignKey('fk-nxt_category_image-category_id', 'nxt_category_image');

        $this->dropPrimaryKey('pk-nxt_category_image', 'nxt_category_image');

        $this->dropTable('nxt_category_image');
    }
}
