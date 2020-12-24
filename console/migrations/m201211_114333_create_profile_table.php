<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m201211_114333_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'user_id' => $this->integer()->notNull()->unique(),
            'description' => $this->string(),
            'status' => $this->string(),
            'avatar' => $this->string()
        ]);
        $this->addForeignKey('user_profile_id', '{{%profile}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%profile}}');
    }
}
