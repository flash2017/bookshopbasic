<?php

use yii\db\Migration;

class m251021_200414_upload_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $userRecord = new \app\models\user\UserRecord();
        $userRecord->attributes = ['username'=>'user', 'password'=>'user'];
        $userRecord->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251021_200414_upload_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251021_200414_upload_user cannot be reverted.\n";

        return false;
    }
    */
}
