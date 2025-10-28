<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\Author\TopAuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Top Author';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(['method' =>'GET', 'action'=>Url::to(['index'])]); ?>

    <?= $form->field($searchModel, 'year_of_publication')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton('Generate report', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'author_id',
            'first_name',
            'last_name',
            'second_name',
            [
                'class' => ActionColumn::class,
                'template' => '{subscribe}',
                'buttons' => ['subscribe' => function ($url, $model, $key) {
                    return Html::a('Subscribe ', '/subscribe/create?author_id='.$model['author_id']);
                }]
            ],
        ],
    ]); ?>


</div>
