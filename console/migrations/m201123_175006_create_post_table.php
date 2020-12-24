<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m201123_175006_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' =>$this->string(),
            'author' => $this->integer()->notNull(),
            'body' => $this->text()->notNull(),
            'sentence_count' => $this->integer()->defaultValue(0)
        ]);

        $this->addForeignKey('fk_user_id_post_author', '{{%post}}', 'author', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
