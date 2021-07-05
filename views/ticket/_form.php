<?php
    use yii\helpers\Html;
?>


<div class="form-group">
    <?php
        echo $form->errorSummary($tickets);
        echo Html::submitButton('Reserve seats', ['class' => 'btn btn-success reservation']); 
    ?>
</div>

<?= $form->field($tickets, "name"); ?>

<?= $form->field($tickets, "phone_num"); ?>

<?= $form->field($tickets, "email"); ?>
