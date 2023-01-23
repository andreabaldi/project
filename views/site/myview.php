<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Ospiti $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ospitis', 'url' => ['myindex']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ospiti-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
            <div class="col-lg-4">
                <h2>Gestione Presenze Mensa</h2>

                <p>La Web App Antoniano Welcome  implementa i servizi informatici per la gestione delle presenze
                    degli ospiti della mensa Padfre Ernesto.
                    .</p>


                    <?php 

echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'nazionalita'
        ],  
]);?>

            </div>
            <div class="col-lg-4">
                <h2>Gestione Ospiti</h2>

        ],
    ]) ?>

</div>
