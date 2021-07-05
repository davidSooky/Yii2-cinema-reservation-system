<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$isMainPage = $title == "Screenings";
$isMainPage && $this->params['breadcrumbs'][] = $this->title;

$columns = [
    ["class" => SerialColumn::class],
    [
        'attribute' => 'movie_id',
        'content' => fn($model) => $model->movie->title
    ],
    'day',
    'start',
    'end',
    [
        "attribute" => "price",
        "content" => fn($model) => $model->getPrice()
    ],
    [
        "label" => "Seats reserved",
        "value" => fn($model) => $model->getNumOfTickets() . "/40"
    ],
    [
        'class' => ActionColumn::class,
        "header" => "View",
        "template" =>"{view}"
    ] 
];

?>
<div class="screening-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            if($isMainPage) {
                echo Html::a('Create Screening', ['create'], ['class' => 'btn btn-success']);
            }  
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns
    ]); ?>

</div>
