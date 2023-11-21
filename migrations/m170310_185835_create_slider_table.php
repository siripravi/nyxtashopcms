<?php

use yii\db\Migration;

/**
 * Handles the creation of table `slider`.
 */
class m170310_185835_create_slider_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
       
        $this->createTable('{{%slider}}', [
            'id' => $this->primaryKey(),            
            'title' => $this->string(),
			'image_count' => $this->integer(),            
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);
        
		
        $this->createTable('{{%slider_image}}', [
            'id' => $this->primaryKey(),			
            'slider_id'  => $this->integer()->notNull(),
            'hash' => $this->string()->notNull(),
			'filename' => $this->string()->notNull(),
            'extension' => $this->string()->notNull(),
			'mimeType' => $this->string()->notNull(),
			'byteSize' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)			
						
        ], $tableOptions);
		
        $this->createTable('{{%slider_image_lang}}', [
            'slider_image_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),           
            'title' => $this->string()->notNull(),          
            'html' => $this->text(),
           
        ], $tableOptions);
        
		$this->addPrimaryKey('pk_nxt_slider_image_lang', '{{%slider_image_lang}}', ['slider_image_id', 'lang_id']);
        $this->createIndex('fk-nxt_slider_image_lang-lang_id', '{{%slider_image_lang}}', ['lang_id']);        
        $this->addForeignKey('fk-nxt_slider_image-slider_id', '{{%slider_image}}', 'slider_id', '{{%slider}}', 'id', 'CASCADE', 'CASCADE');
       // $this->addForeignKey('fk-nxt_slider_image_lang-slider_image_id', '{{%slider_image_lang}}', 'slider_image_id', '{{%slider_image}}', 'id', 'CASCADE');

       // $this->addForeignKey('fk-nxt_slider_image_lang-lang_id', '{{%slider_image_lang}}', 'lang_id', '{{%language}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        
        $this->dropPrimaryKey('pk_nxt_slider_image_lang', '{{%slider_image_lang}}');
		$this->dropForeignKey('fk-nxt_slider_image_lang-slider_image_id', '{{%slider_image_lang}}');
        $this->dropForeignKey('fk-nxt_slider_image_lang-lang_id', '{{%slider_image_lang}}');
		       
        $this->dropTable('{{%slider}}');
        $this->dropTable('{{%slider_image}}');
        $this->dropTable('{{%slider_image_lang}}');
    }
}
