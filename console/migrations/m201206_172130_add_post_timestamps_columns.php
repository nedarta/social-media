<?php

use yii\db\Migration;

/**
 * Class m201206_172130_add_post_timestamps_columns
 */
class m201206_172130_add_post_timestamps_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'created_at', $this->integer()->notNull());
        $this->addColumn('post', 'updated_at', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'created_at');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201206_172130_add_post_timstamps_columns cannot be reverted.\n";

        return false;
    }
    */
}
