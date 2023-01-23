<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Presneze $model */


$this->title = 'Presenze nei Trimestri';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Tabella Entrate nei trimestri</h2>


                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'Trimestre',
            'Presenze'
        ],  
]);?>

   


</div>
