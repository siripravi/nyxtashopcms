<?php

use yii\db\Migration;

/**
 * Handles the creation of table `variant_image`.
 */
class m170311_110757_create_nxt_variant_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_variant_image', [
            'variant_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'enabled' => $this->integer()->notNull()->defaultValue(1),
            'position' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_variant_image', 'nxt_variant_image', ['variant_id', 'image_id']);
        
        $this->addForeignKey('fk-nxt_variant_image-variant_id', 'nxt_variant_image', 'variant_id', 'nxt_variant', 'id', 'CASCADE');
        
        $this->addForeignKey('fk-nxt_variant_image-image_id', 'nxt_variant_image', 'image_id', 'nxt_image', 'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_variant_image-image_id', 'nxt_variant_image');
        
        $this->dropForeignKey('fk-nxt_variant_image-variant_id', 'nxt_variant_image');
        
        $this->dropPrimaryKey('pk-nxt_variant_image', 'nxt_variant_image');
        
        $this->dropTable('nxt_variant_image');
    }
}
