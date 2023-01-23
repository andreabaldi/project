<?php
 
namespace app\controllers;
 
use Yii;
use yii\web\Controller;
use app\models\Presenze;
 
class PresenzeController extends Controller
{
    public function actionCreate()
    {
        $model = new Presenze;
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model
            return $this->render('view', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('create', ['model' => $model]);
        }
    }
}
?>