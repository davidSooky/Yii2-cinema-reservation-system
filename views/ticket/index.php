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
                'content' => function ($model) {
                    $screening = $model->screening;
                    return $screening->getMovieTitle($screening->movie_id);
                }
            ],
            "screening.day",
            "screening.start",
            "screening.end",
            'seat',
            'name',
            'phone_num',
            'email:email',
        ],
    ]); ?>


</div>
