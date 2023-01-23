<?php

namespace app\models;


/**
 * OspitiSearch represents the model behind the search form of `app\models\Ospiti`.
 */
class PartiesSearch extends Parties
{
    public $from_date;
    public $to_date;


    //add rule

    public function rules(){
        return [
            //... your rules,
            [['from_date', 'to_date'], 'safe']
        ];
    }

    //... some code

    public function search($params = []){

        $query = (new Query())
            ->select (['billdate','billno','bills_partyname','billamount'])
            ->from('bills');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if( !($this->load($params) && $this->validate()) ){
            return $dataProvider;
        }

        if($this->from_date && $this->to_date)
            $query->where(['between', 'billdate', $this->from_date, $this->to_date]);

        return $dataProvider;
    }
}
