<?php

use yii\db\Migration;

/**
 * Handles the creation of table `unit`.
 */
class m170310_184656_create_nxt_unit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_unit', [
            'id' => $this->primaryKey(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_unit_lang', [
            'unit_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_unit_lang', 'nxt_unit_lang', ['unit_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_unit_lang-unit_id', 'nxt_unit_lang', 'unit_id', 'nxt_unit', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_unit_lang-lang_id', 'nxt_unit_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE');

        $this->insert('nxt_unit', []);

        $id = 1;

        $this->update('nxt_unit', ['position' => $id], ['id' => $id]);

        $this->batchInsert('nxt_unit_lang', ['unit_id', 'lang_id', 'name'], [
            [$id, 'ru', 'шт'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_unit_lang-lang_id', 'nxt_unit_lang');

        $this->dropForeignKey('fk-nxt_unit_lang-unit_id', 'nxt_unit_lang');

        $this->dropPrimaryKey('pk-nxt_unit_lang', 'nxt_unit_lang');

        $this->dropTable('nxt_unit_lang');
        
        $this->dropTable('nxt_unit');
    }
}
