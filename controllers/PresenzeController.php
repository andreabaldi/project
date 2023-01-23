<?php

namespace app\controllers; 
use Yii;
use yii\web\Controller;
use app\models\Presenze;
use app\models\PresenzeSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Yii\db\QueryBuilder;
use yii\data\ArrayDataProvider;

/**
 * PresenzeController implements the CRUD actions for Presenze model.
 */
class PresenzeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Presenze models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PresenzeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presenze model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    /**
     * Creates a new Presenze model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Presenze();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ospiti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Presenze model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presenze model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Presenzei the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presenze::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMyindex()
    {
    

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
        
    $d2 = date('Y-m-d', strtotime($d1. ' - 10 days'))." 00:00:00";

    $qr->select('[[Presenze.id]], 
    [[Presenze.entrata]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],',)
    ->from('{{Presenze}}')
    ->innerJoin('{{Ospiti}}', '[[Ospiti.id]] = [[Presenze.id]]')
    ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // buiold and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','cognome', 'nome', 'entrata'],
         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('myindex',
                ['dataProvider' =>$dataprovider,]
         );

}


/*()
     * Displays homepage.
     *
     * @return string
     */
    public function actionPanno()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
        
    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";
    $qr->select('Year([[Presenze.entrata]]) AS Anno, COUNT([[Presenze.id]]) as Presenze')
    ->from('{{Presenze}}')
    ->groupby('Year([[Presenze.entrata]])')
    ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Anno','Presenze']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('anno',
                ['dataProvider' =>$dataprovider,]
         );

}

/*()
     * Displays homepage.
     *
     * @return string
     */
    public function actionPtrimestri()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";


    $qr->select('QUARTER([[Presenze.entrata]]) AS Trimestre, COUNT([[Presenze.id]]) as Presenze')
    ->from('{{Presenze}}')
    ->groupby('QUARTER([[Presenze.entrata]])')
    ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Trimestre','Presenze']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('trimestre',
                ['dataProvider' =>$dataprovider,]
         );

}
/*
     * Displays homepage.
     *
     * @return string
     */
    public function actionPmesi()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";

    $qr->select('MONTH([[Presenze.entrata]]) AS Mese, COUNT([[Presenze.id]]) as Presenze')
    ->from('{{Presenze}}')
    ->groupby('MONTH([[Presenze.entrata]])')
    ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Trimestre','Presenze']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('mesi',
                ['dataProvider' =>$dataprovider,]
         );

}


/*
     * Displays homepage.
     *
     * @return string
     */
    public function actionPcount()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";
    

    $qr->select('[[Ospiti.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],
    COUNT([[Presenze.id]]) as presenze,
    ',)
    ->from('{{Ospiti}}')
    ->leftjoin('{{presenze}}', '[[Ospiti.id]] = [[Presenze.id]]')
    ->groupby('[[Ospiti.id]], [[Ospiti.nome]],[[Ospiti.cognome]]');
    //->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    //->limit(250);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','nome', 'cognome','presenze']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('countpres',
                ['dataProvider' =>$dataprovider,]
         );

}


}


