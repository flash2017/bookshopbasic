<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LnkBookAuthors $model */

$this->title = 'Update Lnk Book Authors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lnk Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lnk-book-authors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
