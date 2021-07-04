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

<!-- <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
</div>
<div class="form-group">
    <label for="phone_num">Phone number</label>
    <input type="text" class="form-control" id="phone_num" name="phone_num"placeholder="Enter your phone number">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email"placeholder="Enter your email">
</div> -->