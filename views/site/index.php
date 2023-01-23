<?php

/** @var yii\web\View $this */
use yii\widgets\ListView; 
use yii\grid\GridView;


$this->title = 'Antoniano Web Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        
    <h1 class="display-4">Antoniano WEb App</h1>
    <h2 class="display-4">Mensa Padre Ernesto!</h2>

        <p class="lead">Powered by the Yii  Framework.</p>
    </div>

    <div class="body-content">

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

                <p>I servizi di gestione presenze si affiancano a quelli della gestione erinnove delle tessere di presenza al fine di garantire
                    una corretta e regolare contatto con gli ospiti.</p>
                    <p>Ecco gli  Ospiti Registrati negli utimi 3 giorni</p>

<?php 

$models = $dataProvider->getModels();
// get the number of data items in the current page
$count = $dataProvider->getCount();

// get the total number of data items across all pages
$totalCount = $dataProvider->getTotalCount();
echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nome',
            'cognome',
            'dataRilascio',
            'dataScadenza'
        ],  
]);?>

    

            </div>
            <div class="col-lg-4">
                <h2>Reporting</h2>

                <p>I servizi di reporting consentono di elaborare  statistiche e grafici sui dati collezionati dall' applicazione quali presenze,
                    Nazionalita' degli ospiti, scadenze delle loro tessere.
                </p>

             


                

            </div>
        </div>

    </div>
</div>
