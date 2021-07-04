<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Screening */

$this->title = 'Create Screening';
$this->params['breadcrumbs'][] = ['label' => 'Screenings', 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screening-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "movies" => $movies
    ]) ?>

</div>
