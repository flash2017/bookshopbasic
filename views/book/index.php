<?php

use app\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->getIsGuest() === false ? Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) : ''?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'year_of_publication',
            'isbn',
            //'image',
            //'created_at',
            //'updated_at',
            //'deleted_at',
            [
                'class' => ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                        'view' => true,
                        'update' => Yii::$app->user->getIsGuest() === false,
                        'delete' => Yii::$app->user->getIsGuest() === false,
                ]
            ],
        ],
    ]); ?>


</div>
