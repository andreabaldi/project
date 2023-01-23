<?php
 
namespace app\models;
 
use yii\base\Model;
 
class Status extends Model
{
     
    public $text;
    public $d1;
    public $d2;
 
    public function rules()
    {
        return [
            [['text','text'], 'required'],
            ['d1', 'datetime', 'format' => 'YYYY-mm-dd'],
            ['d2', 'datetime', 'format' => 'YYYY-mm-dd'],
           
        ];
    }
        
}
?>