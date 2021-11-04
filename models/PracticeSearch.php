<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Practice;

/**
 * PracticeSearch represents the model behind the search form of `app\models\Practice`.
 */
class PracticeSearch extends Practice
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'client_id'], 'integer'],
            [['fiscal_code', 'practice_id'], 'safe'],
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
        $query = Practice::find();
       /* $query = Practice::find()
            ->select('clients.*')
            ->join('practices', 'clients.id', '=',  'practices.client_id')
//            ->with('orders')
            ->all();*/

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
        $query->andFilterWhere(['like', 'practice_id', $this->practice_id])
            ->joinWith(['client'])
            ->andFilterWhere(['like', 'fiscal_code', $this->fiscal_code]);

        return $dataProvider;
    }
}
