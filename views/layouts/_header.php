<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->user->isGuest ? Yii::$app->homeUrl : ["screening/index"],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar-expand-lg navbar-dark bg-dark',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]
    ]);

    $menuItems = [
        ['label' => 'Movies', 'url' => ['/site/index'], "visible" => Yii::$app->user->isGuest],
        ['label' => 'Buy tickets', 'url' => ['/site/index'], "visible" => Yii::$app->user->isGuest],
        ['label' => 'Movies', 'url' => ['/movie/index'], "visible" => !Yii::$app->user->isGuest],
        ['label' => 'Screenings', 'url' => ['/screening/all'], "visible" => !Yii::$app->user->isGuest],
        ['label' => 'Reservations', 'url' => ['/ticket/index'], "visible" => !Yii::$app->user->isGuest],
    ];

    if(!Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Logout', 'url' => ['/site/logout'], "linkOptions" => ["data" => ["method" => "POST"]]];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right ml-auto'],
        'items' => $menuItems
    ]);
           
    NavBar::end();

?>
