<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ["class" => SerialColumn::class],
    'day',
    'start',
    'end',
    [
        "attribute" => "price",
        "content" => fn($model) => $model->getPrice()
    ],
    [
        "class" => ActionColumn::class,
        "template" => "{site/screening}",
        "buttons" => [
            "site/screening" => function($url) {
                return Html::a('Buy tickets', $url, ['class' => 'btn btn-success btn-xs']);
            }
        ]
    ]
];

?>
<div class="screening-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        "emptyText" => "No upcoming screenings for this movie.",
        'dataProvider' => $dataProvider,
        'columns' => $columns
    ]); ?>

</div>