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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'movie_id',
                'content' => function ($model) {
                    $screening = $model->screening;
                    return $screening->getMovieTitle($screening->movie_id);
                }
            ],
            'seat',
            'name',
            'phone_num',
            'email:email',
        ],
    ]); ?>


</div>
