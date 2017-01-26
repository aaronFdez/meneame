<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Meneame',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li><a href="#"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true">
            </span>Ciencia</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-plane" aria-hidden="true">
            </span>Drones</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-expand" aria-hidden="true">
            </span>Series</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-flash" aria-hidden="true">
            </span>StratUps</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-knight" aria-hidden="true">
            </span>VideoJuegos</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-retweet" aria-hidden="true">
            </span>Retuits</a></li>
        </ul>
        <p class="navbar-text navbar-left"><a href="">
            <span class="glyphicon glyphicon-plus" aria-hidden="true">
            </span>ENVIAR HISTORIA</a></p>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Aarón &amp; Delgado Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
