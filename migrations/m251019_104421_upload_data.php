<?php

use yii\db\Migration;

class m251019_104421_upload_data extends Migration
{
    public function safeUp()
    {
        $this->insert('book', ['name' => 'book 1', 'description' =>  'description book 1', 'year_of_publication' => 1991, 'isbn' =>'123-123-45-67-123', 'image' => 'http://']);
        $this->insert('book', ['name' => 'book 2', 'description' =>  'description book 2', 'year_of_publication' => 1992, 'isbn' =>'123-123-45-67-124', 'image' => 'http://']);
        $this->insert('book', ['name' => 'book 3', 'description' =>  'description book 3', 'year_of_publication' => 1993, 'isbn' =>'123-123-45-67-125', 'image' => 'http://']);
        $this->insert('book', ['name' => 'book 4', 'description' =>  'description book 4', 'year_of_publication' => 1993, 'isbn' =>'123-123-45-67-126', 'image' => 'http://']);
        $this->insert('book', ['name' => 'book 5', 'description' =>  'description book 5', 'year_of_publication' => 1993, 'isbn' =>'123-123-45-67-127', 'image' => 'http://']);
        $this->insert('book', ['name' => 'book 6', 'description' =>  'description book 6', 'year_of_publication' => 1993, 'isbn' =>'123-123-45-67-128', 'image' => 'http://']);

        $this->insert('author', ['FIRST_NAME' => 'name 1', 'LAST_NAME'=> 'last 1', 'SECOND_NAME' => 'second 1']);
        $this->insert('author', ['FIRST_NAME' => 'name 2', 'LAST_NAME'=> 'last 2', 'SECOND_NAME' => 'second 2']);
        $this->insert('author', ['FIRST_NAME' => 'name 3', 'LAST_NAME'=> 'last 3', 'SECOND_NAME' => 'second 3']);

        $this->insert('lnk_book_authors', ['book_id' => 1, 'author_id' => 1]);
        $this->insert('lnk_book_authors', ['book_id' => 3, 'author_id' => 1]);
        $this->insert('lnk_book_authors', ['book_id' => 2, 'author_id' => 2]);
        $this->insert('lnk_book_authors', ['book_id' => 3, 'author_id' => 2]);
        $this->insert('lnk_book_authors', ['book_id' => 5, 'author_id' => 2]);
        $this->insert('lnk_book_authors', ['book_id' => 2, 'author_id' => 3]);
        $this->insert('lnk_book_authors', ['book_id' => 3, 'author_id' => 3]);
        $this->insert('lnk_book_authors', ['book_id' => 4, 'author_id' => 3]);
        $this->insert('lnk_book_authors', ['book_id' => 3, 'author_id' => 3]);
    }

    public function down()
    {
        echo "m251019_104421_upload_data cannot be reverted.\n";

        return false;
    }

}
