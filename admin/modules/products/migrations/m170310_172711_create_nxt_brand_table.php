<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m170310_172711_create_nxt_brand_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_brand', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_brand_lang', [
            'brand_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_brand_lang', 'nxt_brand_lang', ['brand_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_brand-image_id', 'nxt_brand', 'image_id', 'nxt_image', 'id', 'SET NULL');

        $this->addForeignKey('fk-nxt_brand_lang-brand_id', 'nxt_brand_lang', 'brand_id', 'nxt_brand', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_brand_lang-lang_id', 'nxt_brand_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', 'CASCADE');

        $this->insert('nxt_brand', []);

        $id = 1;

        $this->update('nxt_brand', ['position' => $id], ['id' => $id]);

        $this->batchInsert('nxt_brand_lang', ['brand_id', 'lang_id', 'name'], [
            [$id, 'ru', 'Бренд'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_brand_lang-lang_id', 'nxt_brand_lang');

        $this->dropForeignKey('fk-nxt_brand_lang-brand_id', 'nxt_brand_lang');

        $this->dropForeignKey('fk-nxt_brand-image_id', 'nxt_brand');

        $this->dropPrimaryKey('pk-nxt_brand_lang', 'nxt_brand_lang');

        $this->dropTable('nxt_brand_lang');

        $this->dropTable('nxt_brand');
    }
}
