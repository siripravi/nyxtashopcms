<?php

use yii\db\Migration;

/**
 * Handles adding short text to table `product`.
 */
class m180204_151612_add_text4_column_to_nxt_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('nxt_product_lang', 'text_short', 'text');
        $this->addColumn('nxt_product_lang', 'text_top', 'text');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('nxt_product_lang', 'text_short');
        $this->dropColumn('nxt_product_lang', 'text_top');
    }
}
