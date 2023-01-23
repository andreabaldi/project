<?php
  use yii\helpers\Html;
?>
 
<h1>Your SQL Command</strong></h1>
<p><label>Code</label>:
<?= Html::encode($model->text) ?>
<p><label>Da</label>:
<?= Html::encode($model->d1) ?>
<p><label>A</label>:
<?= Html::encode($model->d2) ?>
