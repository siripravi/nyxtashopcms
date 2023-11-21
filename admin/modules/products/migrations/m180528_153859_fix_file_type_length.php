<?php

use yii\db\Migration;

/**
 * Class m180528_153859_fix_file_type_length
 */
class m180528_153859_fix_file_type_length extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('nxt_file', 'type', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('nxt_file', 'type', $this->string(32)->notNull());
    }
}
