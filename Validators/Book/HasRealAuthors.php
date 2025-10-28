<?php

namespace app\Validators\Book;

use app\models\Author\Author;
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
        if (Author::find()->where(['id' => $model->authors])->count() < 1) {
            $model->addError($attribute, sprintf('Выбранного автора [id = %s] не существует', $model->authors));
        }
    }

}