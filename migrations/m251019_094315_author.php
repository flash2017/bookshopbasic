<?php

use yii\db\Migration;

class m251019_094315_author extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `author` (
                                        id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                        first_name varchar(255) NOT NULL,
                                        last_name varchar(255) NOT NULL,
                                        second_name varchar(255) default NULL,
                                        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                        updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                                        deleted_at timestamp NULL DEFAULT NULL
                                    )");

    }

    public function down()
    {
        echo "m251019_094315_author cannot be reverted.\n";

        return false;
    }

}
