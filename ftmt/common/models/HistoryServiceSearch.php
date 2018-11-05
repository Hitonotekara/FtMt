<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\HistoryService;

/**
 * HistoryServiceSearch represents the model behind the search form of `common\models\HistoryService`.
 */
class HistoryServiceSearch extends HistoryService
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'user_id'], 'integer'],
            [['property', 'prev_value', 'new_value', 'date_modify'], 'safe'],
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
        $query = HistoryService::find();

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
            'entity_id' => $this->entity_id,
            'date_modify' => $this->date_modify,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'property', $this->property])
            ->andFilterWhere(['like', 'prev_value', $this->prev_value])
            ->andFilterWhere(['like', 'new_value', $this->new_value]);

        return $dataProvider;
    }
}
