<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */

$formateo = new Formatter();
$time = $formateo->asTime($model->created_at, $format = 'medium');
$date = $formateo->asDate($model->created_at, $format = 'medium');

$this->title = $model->id_noticia;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
        img {
            width: 50px;
            height: 50px;
        }

    </style>
</head>

<body>
<div class="noticia-view">

    <div class="panel panel-default">
      <div class="panel-body">
        <h2><a href="<?= $model->url ?>"><?= $model->titulo ?></a></h2>

        <p> <?= $model->cuerpo ?> </p>
      </div>
      <div class="panel-footer">
          <div class="panel-footer">
                 <?= Html::a('Comentarios', ['/noticias/view', 'id' => $model->id_noticia], ['class' => 'btn btn-default']) ?>
             <span class="glyphicon glyphicon-option-vertical"></span>
                 Creado por: <?= Html::a($model->usuario->username, ['/user/profile/show', 'id' => $model->usuario->id],
                 ['class' => 'profile-link']) ?> a las <span data-toggle="tooltip" data-placement="top" title="<?= $date ?>"> <?= $time ?> </span>
             <span class="glyphicon glyphicon-option-vertical"> </span>
                 Categoría: <?= Html::a($model->categoria->nombre, ['/noticias/search', 'id' => $model->categoria->id_categoria]) ?>
          </div>
      </div>
    </div>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
      'model' => $model,
      'maxLevel' => 3,
      'entityIdAttribute' => 'id_noticia',
      // set `pageSize` with custom sorting
      'dataProviderConfig' => [
          'sort' => [
              'attributes' => ['id'],
              'defaultOrder' => ['id' => SORT_DESC],
          ],
          'pagination' => [
              'pageSize' => 10
          ],
      ],
          // your own config for comments ListView, for example:
         'listViewConfig' => [
             'emptyText' => Yii::t('app', 'No hay comentarios.'),
         ]
]); ?>

</div>
</body>
