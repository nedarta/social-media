<?php

use yii\db\Migration;

/**
 * Class m201211_075911_add_full_text_index_post
 */
class m201211_075911_add_full_text_index_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%post}} ADD FULLTEXT fulltext_title_body(title,body)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('fulltext_title_body', '{{%post}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201211_075911_add_full_text_index_post cannot be reverted.\n";

        return false;
    }
    */
}
