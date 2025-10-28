<?php

use app\models\Author\Author;
use app\models\Book\Book;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var \app\models\Book\Book $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->isGuest === false ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
        <?= Yii::$app->user->isGuest === false ? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'year_of_publication',
            'isbn',
            'image',
            [
                'attribute' => 'Authors',
                'label' => 'Authors',
                'value' => function (Book $model) {
                    $links = '';
                    /**@var Author $author*/
                    foreach ($model->getAuthors() as $author) {
                        $links .= Html::a('subscribe to '. $author->fullName(), '/subscribe/create?author_id=' . $author->id) . ' ';
                    }
                    return $links;
                },
                'format' => 'raw',
            ],
            'created_at',
            'updated_at',
            'deleted_at',
        ],
    ]) ?>

</div>
