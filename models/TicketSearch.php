<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ticket;

/**
 * TicketSearch represents the model behind the search form of `app\models\Ticket`.
 */
class TicketSearch extends Ticket
{

    public $start;
    public $end;
    public $day;
    public $movie;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'screening_id'], 'integer'],
            [['seat', 'name', 'phone_num', 'email', "start", "end", "day", "movie"], 'safe'],
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
        $query = Ticket::find()->joinWith("screening");
        $query->join("LEFT OUTER JOIN", "movie", "screening.movie_id = movie.id");

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
            'screening_id' => $this->screening_id,
        ]);

        $query->andFilterWhere(['like', 'seat', $this->seat])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'screening.start', $this->start])
            ->andFilterWhere(['like', 'screening.end', $this->end])
            ->andFilterWhere(['like', 'screening.day', $this->day])
            ->andFilterWhere(['like', 'movie.title', $this->movie])
            ->andFilterWhere(['like', 'phone_num', $this->phone_num])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
