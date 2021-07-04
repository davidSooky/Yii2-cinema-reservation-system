<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;

$this->title = Yii::$app->name . " | Main";

    echo ListView::widget([
        "dataProvider" => $dataProvider,
        "itemView" => "_movie_item",
        'layout' => '<div class="d-flex flex-wrap">{items}</div>',
        'itemOptions' => [
            'tag' => false
        ]
    ]);
?>

