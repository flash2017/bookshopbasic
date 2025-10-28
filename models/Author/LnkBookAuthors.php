<?php

namespace app\models\Author;

use app\models\Book\Book;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lnk_book_authors".
 *
 * @property int $id
 * @property int $book_id
 * @property int $author_id
 * @property string $CREATED_AT
 * @property string|null $DELETED_AT
 *
 * @property Author $author
 * @property Book $book
 */
class LnkBookAuthors extends ActiveRecord
{
    public int $year;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lnk_book_authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DELETED_AT'], 'default', 'value' => null],
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
            [['CREATED_AT', 'DELETED_AT'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'author_id' => 'Author ID',
            'CREATED_AT' => 'Created At',
            'DELETED_AT' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

}
