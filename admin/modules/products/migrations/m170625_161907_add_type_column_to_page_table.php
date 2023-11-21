<?php

use yii\db\Migration;

/**
 * Handles adding type to table `page`.
 */
class m170625_161907_add_type_column_to_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('nxt_page', 'type', 'boolean not null default 0');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('nxt_page', 'type');
    }
}
