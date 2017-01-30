<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */

$this->title = $model->id_noticia;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-view">

    <div class="panel panel-default">
      <div class="panel-body">
        <h2><a href="#">Noticia <?= $model->titulo ?></a></h2>

        <p> <?= $model->cuerpo ?> </p>
      </div>
      <div class="panel-footer">
          Creado por: <?= Html::a($model->usuario->username, ['/user/profile/show', 'id' => $model->usuario->id], ['class' => 'profile-link']) ?> el <?= $model->created_at ?>
      </div>
    </div>

</div>