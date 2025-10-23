<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Create User Record';
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
