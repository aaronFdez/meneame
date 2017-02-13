<?php

/* @var $this yii\web\View */
use app\models\NoticiaSearch;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Menéame';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
        .my-navbar {
            background-color: #ff5c00;
            color: white;
        }

        p.navbar-text a {
            color: #ff5c00;
            background-color: lightgrey;
        }

        #meneos {
            text-align: center;
            background-color: lightgray;
            border: 1px black solid;
            height: 80px;
        }

        #meneos p {
            padding: 0;
            margin: 0;
        }

        #meneos button {
            background-color: #ff5c00;
            color: white;
            width: 100%;
            border: 2px solid #ff9f69;
        }

    </style>
</head>

<body>

<div class="site-index">

    <div class="container categorias">
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
    </div>
    <div class="container">
        <p class="navbar-text navbar-left">
            <?= Html::a('+ Enviar historia', ['/noticias/create'], ['class' => 'btn btn-warning']) ?>
        </p>
    </div>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '/noticias/viewmain',
        'layout' => "{items}\n{pager}",
]) ?>

</div>
</body>
