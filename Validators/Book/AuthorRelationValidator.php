<?php
namespace app\Validators\Book;
use app\models\Author;
use yii\validators\Validator;
use app\models\Book;

class AuthorRelationValidator extends Validator
{
    /**
     * @param Book $model
     * @param array $attribute
     * @return bool
     */
    public function validateAttribute($model, $attribute):bool
    {
        $authors = $model->getAuthors();
        $intersecAuthors = array_intersect($authors, $attribute);
        if (empty($intersecAuthors) === false) {
            $model->addError($attribute, 'Переданные авторы уже добавлены');
        }
    }

}