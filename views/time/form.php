<?php 

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\jui\DatePicker;



$this->title = 'Ricerca Temporale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-search">
   <h1><?= Html::encode($this->title) ?></h1>
 
    <p>Seleziona una data per effettuare la ricerca</p>



<div class="form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
            
    <?= $form->field($model, 'data') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]) ?>
    <?= Html::submitButton('Conferma', ['class' => 'btn btn-primary', 'name' => 'data-button']) ?>
        </div>
<p>Seleziona un'intervallo per effettuare la ricerca</p>

        <div class="form-group">
        <?= $form->field($model, 'da') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]),
         $form->field($model, 'a') ->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd',]),
         Html::submitButton('Conferma', ['class' => 'btn btn-primary', 'name' => 'da-a-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- form -->

