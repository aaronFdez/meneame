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
    <style media="screen">
        .my-navbar {
            background-color: #ff5c00;
            color: white;
        }

        .my-navbar a {
            color: white;
        }

        .navbar-text .btn {
            background-color: lightgrey;
        }

        p.navbar-text a {
            color: #ff5c00;
            background-color: lightgrey;
        }

        .site-index .categorias {
            background-color: black;
            margin: -20px 0 auto 0 !important;
            width: 100%;
        }

        .categorias li a {
            color: white;
        }

    </style>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Menéame',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my-navbar navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Administrar usuarios', 'url' => ['/user/admin/index'], 'visible' => (Yii::$app->user->isGuest) ? '' : Yii::$app->user->identity->isAdmin],
            ['label' => 'Administrar noticias', 'url' => ['/noticias/index'], 'visible' => (Yii::$app->user->isGuest) ? '' : Yii::$app->user->identity->isAdmin],
            Yii::$app->user->isGuest ?
            ['label' => 'Iniciar sesión', 'url' => ['/user/security/login']] :
            ['label' => Yii::$app->user->identity->username, 'url' => ['usuarios/index'], 'items' =>
                [
                    ['label' => 'Ver perfil', 'url' => ['/user/profile/show', 'id' => Yii::$app->user->identity->id]],
                    ['label' => 'Editar perfil', 'url' => ['/user/settings/profile']],
                    ['label' => 'Cerrar sesión',
                        'url' => ['/user/security/logout'],
                        'linkOptions' => ['data-method' => 'post']],
                ]
            ],
            ['label' => 'Registrarse', 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest]
        ],
    ]);
    NavBar::end();
    ?>

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
