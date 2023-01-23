<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ospiti;

/**
 * OspitiSearch represents the model behind the search form of `app\models\Ospiti`.
 */
class OspitiSearch extends Ospiti
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cognome', 'nome', 'nascita', 'genere', 'nazionalita'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Ospiti::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'nascita', $this->nascita])
            ->andFilterWhere(['like', 'genere', $this->genere])
            ->andFilterWhere(['like', 'nazionalita', $this->nazionalita]);

        return $dataProvider;
    }
}
