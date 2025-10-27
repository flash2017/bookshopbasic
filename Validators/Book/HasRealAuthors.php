<?php

namespace app\Validators\Book;

use app\models\Author;
use yii\validators\Validator;

class HasRealAuthors extends Validator
{
    /**
     * @param $model
     * @param array $attribute
     * @return void
     */
    public function validateAttribute($model, $attribute): void
    {
        if (Author::find()->where(['id'=>$model->authors])->count() !== count($model->authors)) {
            $model->addError($attribute, 'Выбранного автора не существует');
        }
    }

}