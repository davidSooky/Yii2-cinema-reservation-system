<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Screening */

$this->title = 'Update Screening: ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Screenings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="screening-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "movies" => $movies
    ]) ?>

</div>
