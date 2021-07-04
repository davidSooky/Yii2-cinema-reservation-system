<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Movie */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="screening-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'movie_id')->dropDownList(ArrayHelper::map($movies, "id", "title"), ["prompt" => "Select movie"]); ?>

    <div class="form-group">
        <label for="day">Select date of screening: </label>
        <input type="date" name="day" id="day" value="<?= $model->day ?? date("Y-m-d", time()); ?>">
    </div>

    <div class="form-group">
        <label for="start">Select start time of screening: </label>
        <input type="time" name="start" id="start" value="<?= $model->start ?? date("H:i", time()); ?>">
    </div> 

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
