<?php

use yii\helpers\Html;

?>

<div class="card m-2" style="width: 18rem;">
  <img class="card-img-top" src="<?= $model->getPosterLink(); ?>" alt="No image found.">
  <div class="card-body">
    <?= $model->poster; ?>
    <h5 class="card-title"><?= $model->title; ?></h5>
    <p class="text-muted"><?= $model->year; ?></p>
    <p class="card-text"><?= $model->description; ?></p>
    <?= Html::a('Buy tickets', ['site/movie', "id" => $model->id], ['class' => 'btn btn-success']); ?>
  </div>
</div>