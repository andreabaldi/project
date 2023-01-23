<?php

use yii\widgets\DetailView;
use app\models\Presenze;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Presneze $model */


$this->title = 'Presenze nell Anno';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2> Tabella Entrate per l'anno</h2>


                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'Anno',
            'Presenze'
        ],  
]);?>

   


</div>
