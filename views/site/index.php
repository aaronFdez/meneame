<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Menéame';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
        .my-navbar {
            background-color: #fc6000;
            color: white;
        }

        p.navbar-text a {
            color: #fc6000;
            background-color: lightgrey;
        }

    </style>
</head>

<body>

<div class="site-index">

    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li><a href="#"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true">
            </span> Ciencia</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-plane" aria-hidden="true">
            </span> Drones</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-expand" aria-hidden="true">
            </span> Series</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-flash" aria-hidden="true">
            </span> StratUps</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-knight" aria-hidden="true">
            </span> VideoJuegos</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-retweet" aria-hidden="true">
            </span> Retuits</a></li>
        </ul>
        <p class="navbar-text navbar-left">
            <?= Html::a('Create Noticia', ['/noticias/create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

</div>
</body>
