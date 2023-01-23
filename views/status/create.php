<?php
  use yii\helpers\Html;
  use yii\widgets\ActiveForm;
  use app\models\Status;
use yii\captcha\Captcha;
use yii\jui\DatePicker;

?>
<?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'text')->textArea(['rows' => '4'])->label('SQL Query'); ?>
 

<div class="form-group">
        <?= $form->field($model, 'd1') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]),
            $form->field($model, 'd2') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',])   ?>
        </div>        
 
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
 
<?php ActiveForm::end(); ?> 