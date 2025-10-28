<?php
namespace app\Validators\Book;
use app\models\Book\Book;
use yii\validators\Validator;

class AuthorRelationValidator extends Validator
{
    /**
     * @param Book $model
     * @param array $attribute
     * @return void
     */
    public function validateAttribute($model, $attribute):void
    {
        $authors = $model->getAuthors();
        $intersecAuthors = array_intersect($authors, $attribute);
        if (empty($intersecAuthors) === false) {
            $model->addError($attribute, 'Переданные авторы уже добавлены');
        }
    }

}