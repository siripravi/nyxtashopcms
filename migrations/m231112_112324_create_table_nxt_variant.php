<?php

use yii\db\Migration;

class m231112_112324_create_table_nxt_variant extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%variant}}',
            [
                'id' => $this->primaryKey(),
                'product_id' => $this->integer()->notNull(),
                'code' => $this->string(),
                'price' => $this->decimal(9, 2),
                'price_old' => $this->decimal(9, 2),
                'currency_id' => $this->integer()->notNull(),
                'unit_id' => $this->integer()->notNull(),
                'available' => $this->integer()->notNull()->defaultValue('1'),
                'image_id' => $this->integer(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'position' => $this->integer()->notNull()->defaultValue('0'),
                'enabled' => $this->boolean()->notNull()->defaultValue('1'),
            ],
            $tableOptions
        );

        $this->createIndex('fk-nxt_variant-unit_id', '{{%variant}}', ['unit_id']);
        $this->createIndex('fk-nxt_variant-currency_id', '{{%variant}}', ['currency_id']);
        $this->createIndex('fk-nxt_variant-product_id', '{{%variant}}', ['product_id']);
        $this->createIndex('idx-nxt_variant-image_id', '{{%variant}}', ['image_id']);

        $this->createTable(
            '{{%variant_image}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'image_id' => $this->integer()->notNull(),
                'enabled' => $this->integer()->notNull()->defaultValue('1'),
                'position' => $this->integer()->notNull()->defaultValue('0'),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_image}}', ['variant_id', 'image_id']);

        $this->addForeignKey(
            'fk-nxt_variant_image-image_id',
            '{{%variant_image}}',
            ['image_id'],
            '{{%image}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-nxt_variant_image-variant_id',
            '{{%variant_image}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->createTable(
            '{{%variant_lang}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'lang_id' => $this->string(3)->notNull(),
                'name' => $this->string(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_lang}}', ['variant_id', 'lang_id']);

        $this->addForeignKey(
            'fk-nxt_variant_lang-lang_id',
            '{{%variant_lang}}',
            ['lang_id'],
            '{{%language}}',
            ['id'],
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-nxt_variant_lang-variant_id',
            '{{%variant_lang}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->createTable(
            '{{%variant_value}}',
            [
                'variant_id' => $this->integer()->notNull(),
                'value_id' => $this->integer()->notNull(),
            ],
            $tableOptions
        );

        $this->addPrimaryKey('PRIMARYKEY', '{{%variant_value}}', ['variant_id', 'value_id']);

        $this->addForeignKey(
            'fk-nxt_variant_value-value_id',
            '{{%variant_value}}',
            ['value_id'],
            '{{%value}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk-nxt_variant_value-variant_id',
            '{{%variant_value}}',
            ['variant_id'],
            '{{%variant}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%variant}}');
        $this->dropTable('{{%variant_image}}');
        $this->dropTable('{{%variant_lang}}');
        $this->dropTable('{{%variant_value}}');
    }
}
