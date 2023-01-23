<?php
 
namespace app\controllers;
 
use Yii;
use yii\web\Controller;
 
class TimeController extends Controller
{
    public function actionForm()
    {
        $model = new \yii\base\DynamicModel([
            'data', 'da', 'a'
        ]);
        $model->addRule(['data','text'], 'required')
            ->addRule(['da', 'text'], 'required')
            ->addRule(['a', 'text'], 'required');
    
        if($model->load(Yii::$app->request->post())){

          

            // do somenthing with model
            return $this->redirect(['view']);
        }
        return $this->render('form', ['model'=>$model]);
    }

   

}
?>