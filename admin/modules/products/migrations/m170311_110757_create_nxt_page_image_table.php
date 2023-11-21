<?php

use yii\db\Migration;

/**
 * Handles the creation of table `page_image`.
 */
class m170311_110757_create_nxt_page_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_page_image', [
            'page_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_page_image', 'nxt_page_image', ['page_id', 'image_id']);
        
        $this->addForeignKey('fk-nxt_page_image-page_id', 'nxt_page_image', 'page_id', 'page', 'id', 'CASCADE');
        
        $this->addForeignKey('fk-nxt_page_image-image_id', 'nxt_page_image', 'image_id', 'nxt_image', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_page_image-image_id', 'nxt_page_image');
        
        $this->dropForeignKey('fk-nxt_page_image-page_id', 'nxt_page_image');
        
        $this->dropPrimaryKey('pk-nxt_page_image', 'nxt_page_image');
        
        $this->dropTable('nxt_page_image');
    }
}
