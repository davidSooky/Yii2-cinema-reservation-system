<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Screening;

/**
 * ScreeningSearch represents the model behind the search form of `app\models\Screening`.
 */
class ScreeningSearch extends Screening
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['movie_id', 'day', 'start', 'end'], 'safe'],
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
        $query = Screening::find();

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
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'movie_id', $this->movie_id])
            ->andFilterWhere(['like', 'day', $this->day])
            ->andFilterWhere(['like', 'start', $this->start])
            ->andFilterWhere(['like', 'end', $this->end]);

        return $dataProvider;
    }
}
