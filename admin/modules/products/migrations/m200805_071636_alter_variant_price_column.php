<?php

use yii\db\Migration;

/**
 * Class m200805_071636_alter_variant_price_column
 */
class m200805_071636_alter_variant_price_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('nxt_variant', 'price', $this->decimal(9,2));

        $this->alterColumn('nxt_variant', 'price_old', $this->decimal(9,2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('nxt_variant', 'price', $this->integer());

        $this->alterColumn('nxt_variant', 'price_old', $this->integer());
    }
}
