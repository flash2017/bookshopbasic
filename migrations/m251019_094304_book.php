<?php

use yii\db\Migration;

class m251019_094304_book extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(1000)->notNull()->defaultValue(''),
            'year_of_publication' => $this->integer(4)->notNull()->defaultValue(0),
            'isbn' => $this->string(18)->null()->unique(),
            'image' => $this->string(1000)->null(),

            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
            'deleted_at' => $this->timestamp()->null(),
        ]);
    }

    public function down()
    {
        echo "m251019_094304_book cannot be reverted.\n";

        return false;
    }

}
