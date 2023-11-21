<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m170310_172422_create_nxt_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'slug' => $this->string()->notNull(),
            'image_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'main' => $this->boolean()->notNull()->defaultValue(0),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_category_lang', [
            'category_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'h1' => $this->string()->notNull(),
            'keywords' => $this->string(),
            'description' => $this->text(),
            'text' => $this->text(),
            'seo' => $this->text(),
        ], $tableOptions);
		
		/*$this->createTable('nxt_category_image', [
            'category_id' => $this->integer()->notNull(),
            'image_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->integer()->notNull()->defaultValue(1),
        ], $tableOptions);
*/
       
        $this->addPrimaryKey('pk-nxt_category_lang', 'nxt_category_lang', ['category_id', 'lang_id']);
		
     /*   $this->addPrimaryKey('pk-nxt_category_image', 'nxt_category_image', ['category_id', 'image_id']);
		*/
        $this->addForeignKey('fk-nxt_category-image_id', 'nxt_category', 'image_id', 'nxt_image', 'id', 'SET NULL');

        $this->addForeignKey('fk-nxt_category-parent_id', 'nxt_category', 'parent_id', 'nxt_category', 'id', 'SET NULL');

        $this->addForeignKey('fk-nxt_category_lang-category_id', 'nxt_category_lang', 'category_id', 'nxt_category', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_category_lang-lang_id', 'nxt_category_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE' );
		
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_category_lang-lang_id', 'category_lang');

        $this->dropForeignKey('fk-nxt_category_lang-category_id', 'nxt_category_lang');

        $this->dropForeignKey('fk-nxt_category-parent_id', 'nxt_category');

        $this->dropForeignKey('fk-nxt_category-image_id', 'nxt_category');

        $this->dropPrimaryKey('pk-nxt_category_lang', 'nxt_category_lang');

        $this->dropTable('nxt_category_lang');

        $this->dropTable('nxt_category');
		
		
    }
}
