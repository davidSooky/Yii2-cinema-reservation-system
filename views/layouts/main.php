<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;

?>

<?php $this->beginContent("@views/layouts/base.php"); ?>
    <?= $this->render("_header"); ?>

    <main class="container">
        <div class="breadcrumbs my-2">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]) ?>
        </div>

        <?= Alert::widget() ?>
        <?= $content ?>
    </main>

    <?= $this->render("_footer"); ?>
<?php $this->endContent(); ?>