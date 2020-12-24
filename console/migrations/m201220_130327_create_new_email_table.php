<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%new_email}}`.
 */
class m201220_130327_create_new_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%new_email}}', [
            'user_id' => $this->integer()->notNull(),
            'email' => $this->string()->notNull(),
            'token' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
        ]);
        $this->createIndex('token_idx', '{{%new_email}}', 'token');
        $this->addForeignKey('user_id_f_key', '{{%new_email}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%new_email}}');
    }
}
