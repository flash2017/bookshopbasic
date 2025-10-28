<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var \app\models\Author\LnkBookAuthors $model */

$this->title = 'Create Lnk Book Authors';
$this->params['breadcrumbs'][] = ['label' => 'Lnk Book Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lnk-book-authors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
