<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuerpo')->textArea(['maxlength' => true, 'rows'=>6, 'cols'=>50]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'pattern' => "^(http|https):\/\/(w{3}\.|)[a-zA-Z0-9]+\.[a-z]{1,3}$"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
