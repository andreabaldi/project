<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;

use yii\captcha\Captcha;
use yii\jui\DatePicker;


/** @var yii\web\View $this */
/** @var app\models\Presenze $model */


$this->title = 'Presenze Totali';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Tabella Entrata</h2>


                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'presenze',
        ],  
]);?>

   


</div>
