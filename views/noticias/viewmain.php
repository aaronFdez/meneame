<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
$time = new Formatter();
$time = $time->asTime($model->created_at, $format = 'medium');
?>
<div class="noticia-view">

    <div class="panel panel-default">
      <div class="panel-body">
        <h2><a href="<?= $model->url ?>"><?= $model->titulo ?></a></h2>

        <p> <?= $model->cuerpo ?> </p>
      </div>
      <div class="panel-footer">
        <?= Html::a('Comentarios', ['/noticias/view', 'id' => $model->id_noticia], ['class' => 'btn btn-default']) ?>
        Creado por: <?= Html::a($model->usuario->username, ['/user/profile/show', 'id' => $model->usuario->id], ['class' => 'profile-link']) ?> a las <?= $time ?>
      </div>
    </div>

</div>
