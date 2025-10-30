<?php

use app\models\Author\Author;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\Book\Book $model */
/** @var yii\widgets\ActiveForm $form */

$authorsSearchUrl = '/author/search';
$authorsDataList = $model->getAuthors();
$authorsList = ArrayHelper::map($authorsDataList, 'id', 'fullName');
$model->authors = array_keys($authorsList);
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_of_publication')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?php /*= /*$form->field($model, 'image')->textInput(['maxlength' => true])*/ ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php echo $form->field($model, 'authors')->widget(Select2::class, [
        'data' => $authorsList,
     //   'value'=> $authorsListValue,
        'pluginOptions' => [
            'tags' => true,
            'allowClear' => true,
            'minimumInputLength' => 3,
            'language' => [
                'errorLoading' => new JsExpression("function () { return 'Waiting...'; }"),
            ],
            'ajax' => [
                'url' => $authorsSearchUrl,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {author_name:params.term}; }')
            ],
            'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            'templateResult' => new JsExpression('function(author) { return author?.fullName ?? ""; }'),
            'templateSelection' => new JsExpression('function(author) { return author?.fullName ?? author; }'),
        ],
        'options' => [
            'multiple' => true,
            'placeholder' => 'Select a author ...'
        ]
    ]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
