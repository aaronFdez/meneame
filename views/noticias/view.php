<?php

use yii\helpers\Url;
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

$url = Url::to(['noticias/meneos']);
$js = <<<EOT
    $('.bMeneos').click(function() {
        $.ajax({
            method: 'POST',
            url: '$url',
            context: this,
            data: {
                id: $(this).val()
            },
            success: function (data, status, event) {
                $(this).html("¡hecho!");
                $(this).prev().prev().html(data);
            }
        });
    });
EOT;
$this->registerJs($js);
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
<div class="noticia-view">

    <div class="media">
      <div class="media-left">
          <div id="meneos">
              <p><?= $model->numeroMeneos ?></p>
              <p>meneos</p>
              <button type="button" name="button" class="bMeneos" value="<?= $model->id_noticia ?>">menéalo</button>
          </div>
      </div>
      <div class="media-body">
          <div class="panel panel-default">
            <div class="panel-body">
              <h2><a href="<?= $model->url ?>"><?= $model->titulo ?></a></h2>

              <p> <?= $model->cuerpo ?> </p>
            </div>
            <div class="panel-footer">
                   Creado por: <?= Html::a($model->usuario->username, ['/user/profile/show', 'id' => $model->usuario->id],
                   ['class' => 'profile-link']) ?> a las <span data-toggle="tooltip" data-placement="top" title="<?= $date ?>"> <?= $time ?> </span>
               <span class="glyphicon glyphicon-option-vertical"> </span>
                   Categoría: <?= Html::a($model->categoria->nombre, ['/noticias/search', 'id' => $model->categoria->id_categoria]) ?>
            </div>
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
