<?php

use yii\db\Migration;

class m251019_094334_lnk_book_author extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->execute("CREATE TABLE IF NOT EXISTS `lnk_book_authors` (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            book_id int NOT NULL ,    
            author_id int NOT NULL ,
            CREATED_AT TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            DELETED_AT TIMESTAMP NULL DEFAULT NULL,
            FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE RESTRICT ON UPDATE RESTRICT, 
            FOREIGN KEY (author_id) REFERENCES author (id)  ON DELETE RESTRICT ON UPDATE RESTRICT
        )");
    }

    public function down()
    {
        echo "m251019_094334_lnk_book_author cannot be reverted.\n";

        return false;
    }

}
