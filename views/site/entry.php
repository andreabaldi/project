<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->label('Sender Name') ?>

    <?= $form->field($model, 'email')->label('Sender Email') ?>

    <div class="form-group">
        <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>