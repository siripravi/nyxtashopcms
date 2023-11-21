<?php

use yii\db\Migration;

/**
 * Handles the creation of table `value`.
 */
class m170310_184658_create_nxt_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('nxt_value', [
            'id' => $this->primaryKey(),
            'feature_id' => $this->integer()->notNull(),
            'position' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createTable('nxt_value_lang', [
            'value_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-nxt_value_lang', 'nxt_value_lang', ['value_id', 'lang_id']);

        $this->addForeignKey('fk-nxt_value_lang-feature_id', 'nxt_value', 'feature_id', 'nxt_feature', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_value_lang-value_id', 'nxt_value_lang', 'value_id', 'nxt_value', 'id', 'CASCADE');

        $this->addForeignKey('fk-nxt_value_lang-lang_id', 'nxt_value_lang', 'lang_id', 'nxt_language', 'id', 'CASCADE', );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-nxt_value_lang-lang_id', 'nxt_value_lang');

        $this->dropForeignKey('fk-nxt_value_lang-value_id', 'nxt_value_lang');

        $this->dropForeignKey('fk-nxt_value_lang-feature_id', 'nxt_value');

        $this->dropPrimaryKey('pk-nxt_value_lang', 'nxt_value_lang');
        
        $this->dropTable('nxt_value_lang');
        
        $this->dropTable('nxt_value');
    }
}
