<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Movies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Movie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ["class" => SerialColumn::class],
            'title',
            'year',
            'description',
            // 'duration',
            [
                "attribute" => "duration",
                "value" => fn($model) => $model->getMinutes()
            ],
            [
                'class' => ActionColumn::class,
                "template" => "{update} {delete}"
        ]   ,
        ],
    ]); ?>


</div>
