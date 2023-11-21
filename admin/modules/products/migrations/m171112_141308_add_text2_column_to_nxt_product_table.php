<?php

use yii\db\Migration;

/**
 * Handles adding text2 to table `product`.
 */
class m171112_141308_add_text2_column_to_nxt_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('nxt_product_lang', 'text_tips', 'text');
        $this->addColumn('nxt_product_lang', 'text_features', 'text');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('nxt_product_lang', 'text_tips');
        $this->dropColumn('nxt_product_lang', 'text_features');
    }
}
