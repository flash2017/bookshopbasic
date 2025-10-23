<?php

use yii\db\Migration;

class m251022_203728_subscribe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscribe', [
            'id' => $this->primaryKey(),
            'phone' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-subscribe-author_id-phone', 'subscribe', ['phone', 'author_id'], true);
        $this->addForeignKey('fk_auth', 'subscribe', 'author_id', 'author', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251022_203728_subscribe_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251022_203728_subscribe_table cannot be reverted.\n";

        return false;
    }
    */
}
