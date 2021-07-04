<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        "filterModel" => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'movie_id',
                "label" => "Movie",
                'value' => function ($model) {
                    $screening = $model->screening;
                    return $screening->getMovieTitle($screening->movie_id);
                }
            ],
            [
                "label" => "Date",
                "attribute" => "day",
                "value" => fn($model) => $model->screening->day
            ],
            [
                "label" => "Start",
                "attribute" => "start",
                "value" => fn($model) => $model->screening->start
            ],
            [
                "label" => "End",
                "attribute" => "end",
                "value" => fn($model) => $model->screening->end
            ],
                'seat',
                'name',
                'phone_num',
                'email:email',
        ],
    ]); ?>


</div>
