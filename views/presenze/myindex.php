<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Presneze $model */


$this->title = 'Ultimi Presenze del giorno';
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
            'entrata',
            'nome',
            'cognome',
        
        ],  
]);?>

   


</div>
