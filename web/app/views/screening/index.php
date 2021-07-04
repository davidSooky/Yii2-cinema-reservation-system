<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Screenings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screening-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Screening', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'movie_id',
            'day',
            'start',
            'end',
            //'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
