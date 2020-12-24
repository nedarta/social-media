<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m201123_172956_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->string(40)->notNull(),
            'expire' => $this->integer(),
            'data' => $this->binary()
        ]);

        $this->addPrimaryKey('pk_id', '{{%session}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
