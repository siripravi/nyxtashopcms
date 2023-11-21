<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m170310_104136_create_nxt_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_image', [
            'id' => $this->primaryKey(),
            'file_id' => $this->integer()->notNull(),
            'method' => $this->string(10),
            'name' => $this->string()->notNull(),
            'alt' => $this->string(),
            'rotate' => $this->smallInteger(),
            'mirror' => $this->boolean()->defaultValue(false),
            'width' => $this->integer()->notNull(),
            'height' => $this->integer()->notNull(),
            'x' => $this->integer(),
            'y' => $this->integer(),
            'zoom' => $this->smallInteger(3),
            'watermark' => $this->boolean(),
        ], $tableOptions);

        $this->addForeignKey('fk-nxt_image-file_id', 'nxt_image', 'file_id', 'nxt_file', 'id', 'CASCADE');
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-image-file_id', 'nxt_image');

        $this->dropTable('nxt_image');
    }
}
