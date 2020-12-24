<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cache}}`.
 */
class m201123_172439_create_cache_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cache}}', [
            'id' => $this->string(128)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary()
        ]);

        $this->addPrimaryKey('pk_id', '{{%cache}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cache}}');
    }
}
