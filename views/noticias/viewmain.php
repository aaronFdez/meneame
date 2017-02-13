<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\i18n\Formatter;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
$formateo = new Formatter();
$time = $formateo->asTime($model->created_at, $format = 'medium');
$date = $formateo->asDate($model->created_at, $format = 'medium');

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
<div class="noticia-view">

    <div class="meneos">
        <p><?= $model->numeroMeneos ?></p>
        <p>meneos</p>
        <button type="button" name="button" class="bMeneos" value="<?= $model->id_noticia ?>">menéalo</button>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <h2><a href="<?= $model->url ?>"><?= $model->titulo ?></a></h2>

        <p> <?= $model->cuerpo ?> </p>
      </div>
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
