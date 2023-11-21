<?php

use yii\db\Migration;

/**
 * Class m191115_134456_index_hash_files
 */
class m191115_134456_index_hash_files extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx-hash', 'nxt_file', 'hash');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-hash', 'nxt_file');
    }
}
