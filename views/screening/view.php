<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Screening */

$this->title = $model->getMovieTitle($model->movie_id);
$isGuest = Yii::$app->user->isGuest;
$reservedSeats = array_keys($model->reservedSeats);

if(!$isGuest) {
    $this->params['breadcrumbs'][] = ['label' => 'Screenings', 'url' => 'all'];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Screenings for movie ' . $this->title , 'url' => ["site/movie", "id" => $model->movie_id]];
}
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="screening-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-9">
            <?= $this->render("_screen", ["reservedSeats" => $reservedSeats, "tickets" => $tickets ?? null]); ?>
        </div>
        <div class="col-sm-3">
            <div class="buttons m-2">
                <?php 
                    if (!$isGuest && !$numOfTickets) {
                        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary mx-2']);
                        echo Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger mx-2',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item ?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ?>
            </div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'day',
                    [
                        "label" => "Duration",
                        "value" => fn($model) => $model->getDuration($model->movie_id) . " minutes"
                    ],
                    'start',
                    'end',
                    [
                        "attribute" => "price",
                        "value" => fn($model) => $model->getPrice() 
                    ]
                ],
            ]) ?>

            <h6 class="my-2 text-muted" id="seat-summary">
                <?php 
                    if (!$isGuest) {
                        echo "Tickets sold: " . $numOfTickets . " / 40";
                    } else {
                        echo "Number of selected seats: ";
                    }
                ?>
                 <span class="seat-summary"><?= !$isGuest ? null : 0 ; ?></span>
            </h6>
            <h6 class="my-2 text-muted">
                <?php 
                    if (!$isGuest) {
                        echo "Income: " . $model->getPrice($numOfTickets);
                    }  
                ?>
            </h6>

        </div>
    </div>
</div>
