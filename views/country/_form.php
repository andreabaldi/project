<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Country $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'iso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nicename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numcode')->textInput() ?>

    <?= $form->field($model, 'phonecode')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
