<?php

use app\models\user\UserRecord;
use yii\db\Migration;

class m251021_201313_create_role_for_default_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** @var \yii\rbac\DbManager $rbac */
        $rbac = \Yii::$app->authManager;

        $guest = $rbac->createRole('guest');
        $guest->description = 'Guest';
        $rbac->add($guest);

        $user = $rbac->createRole('user');
        $user->description = 'User';
        $rbac->add($user);

        $rbac->addChild($user, $guest);

        $rbac->assign($user,
            UserRecord::findOne(['username' => 'user'])->id
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251021_201313_create_role_for_default_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251021_201313_create_role_for_default_user cannot be reverted.\n";

        return false;
    }
    */
}
