<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m170310_184312_create_nxt_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_currency', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3)->notNull(),
            'rate' => $this->decimal(8, 4)->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('nxt_currency_lang', [
            'currency_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'before' => $this->string(),
            'after' => $this->string(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_currency_lang', 'nxt_currency_lang', ['currency_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_currency_lang-currency_id', 'nxt_currency_lang', 'currency_id', 'nxt_currency', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_currency_lang-lang_id', 'nxt_currency_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE' );

        $this->insert('nxt_currency', [
            'code' => 'UAH',
            'rate' => 1,
        ]);

        $id = 1;

        $this->update('nxt_currency', ['position' => $id], ['id' => $id]);

        $this->batchInsert('nxt_currency_lang', ['currency_id', 'lang_id', 'name', 'after'], [
            [$id, 'ru', 'Гривна', 'грн '],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_currency_lang-lang_id', 'nxt_currency_lang');

        $this->dropForeignKey('fk-nxt_currency_lang-currency_id', 'nxt_currency_lang');

        $this->dropPrimaryKey('pk-nxt_currency_lang', 'nxt_currency_lang');

        $this->dropTable('nxt_currency_lang');
        
        $this->dropTable('nxt_currency');
    }
}
