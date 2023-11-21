<?php

use yii\db\Migration;

/**
 * Handles adding text3 to table `product`.
 */
class m171209_103939_add_text3_column_to_nxt_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('nxt_product_lang', 'text_process', 'text');
        $this->addColumn('nxt_product_lang', 'text_use', 'text');
        $this->addColumn('nxt_product_lang', 'text_storage', 'text');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('nxt_product_lang', 'text_process');
        $this->dropColumn('nxt_product_lang', 'text_use');
        $this->dropColumn('nxt_product_lang', 'text_storage');
    }
}
