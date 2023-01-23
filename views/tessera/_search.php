<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TesseraSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tessera-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dataRilascio') ?>

    <?= $form->field($model, 'dataUltimoRinnovo') ?>

    <?= $form->field($model, 'dataScadenza') ?>

    <?= $form->field($model, 'QRfilename') ?>

    <?php // echo $form->field($model, 'TSfilename') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
