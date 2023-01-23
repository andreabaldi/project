<?php

namespace app\controllers;

use Yii;
use Yii\db\QueryBuilder;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;




class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}



    $d1 = date('Y-m-d')." 23:59:59";
        
    $d2 = date('Y-m-d', strtotime($d1. ' - 10 days'))." 00:00:00";
    

    $qr->select('[[Ospiti.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]], 
    [[Ospiti.nazionalita]], 
    [[Tessera.dataRilascio]], 
    [[Tessera.dataUltimoRinnovo]], 
    [[Tessera.dataScadenza]], 
    [[Tessera.QRfilename]], 
    [[Tessera.TSfilename]]')
    ->from('{{Ospiti}}')
    ->innerJoin('{{Tessera}}', '[[Ospiti.id]] = [[Tessera.id]]')
    ->where('[[Tessera.dataRilascio]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // buiold and executre the query made then avaiable in rows
    $rows = $qr->all();   

    //$query = Yii::$app->db->CreateCommand('SELECT [[id]],[[nome]], [[cognome]]  FROM {{Ospiti}} WHERE [[nome]] = "Mohamed" ');
   // $query = Yii::$app->db->CreateCommand('SELECT 
  //[[Ospiti.id]], 
  //[[Ospiti.nome]], 
  //[[Ospiti.cognome]], 
  //[[Ospiti.nazionalita]], 
  //[[Tessera.dataRilascio]], 
  //[[Tessera.dataUltimoRinnovo]], 
  //[[Tessera.dataScadenza]], 
  //[[Tessera.QRfilename]], 
  //[[Tessera.TSfilename]]
  // FROM 
  //{{Ospiti}}
  //inner JOIN {{Tessera}} ON [[Ospiti.id]] = [[Tessera.id]]');
    
    
    $dataprovider = new ArrayDataProvider([
   // 'allModels' => $query->queryAll(),
    'allModels' => $rows,
    'sort' => [
        'attributes' => ['cognome', 'nome'],
    ],
    'pagination' => [
        'pageSize' => 25,
    ],
    ]);

    
        return $this->render('index',
           ['dataProvider' =>$dataprovider,]
    );
    
}
    




    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbb($par)
    {
        echo $par;
        return $this->render('ab');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAb()
    {
        return $this->render('ab');
    }



    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }



    
    public function actionForm()
    {
        $model = new \yii\base\DynamicModel([
            'data', 'da', 'a'
        ]);
        $model->addRule(['data','date'], 'required')
            ->addRule(['da', 'date'], 'required')
            ->addRule(['a', 'date'], 'required');
    
        if($model->load(Yii::$app->request->post())){

            $sqr = (new \yii\db\Query());

            // do somenthing with model
            return $this->redirect(['andrea']);
        }
        return $this->render('form', ['model'=>$model]);
    }


}
