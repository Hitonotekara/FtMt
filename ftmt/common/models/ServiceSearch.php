<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Service;

/**
 * ServiceSearch represents the model behind the search form of `common\models\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'city_id'], 'integer'],
            [['name', 'code', 'description', 'expired', 'city.name'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        // подключаем поиск по полю city.name (делаем поле city.name доступным для поиска в gridview)
        return array_merge(parent::attributes(), ['city.name']);
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
        $query = Service::find()
            // задаем алиас `serv` для таблицы основной сущности (Service)
            ->from(['serv' => Service::tableName()])
            // подключаем джойн с таблицей связанной сущности (City) и задаем ей алиас `city`
            ->joinWith('city city');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        // подключаем сортировку по полю city.name
        $dataProvider->sort->attributes['city.name'] = [
            'asc' => ['city.name' => SORT_ASC],
            'desc' => ['city.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // в названиях полей используем алиасы таблиц
        $query->andFilterWhere([
            'serv.id' => $this->id,
            'serv.price' => $this->price,
            'serv.status' => $this->status,
            'serv.expired' => $this->expired,
            'serv.city_id' => $this->city_id,
        ]);
        $query->andFilterWhere(['like', 'serv.name', $this->name])
            ->andFilterWhere(['like', 'serv.code', $this->code])
            ->andFilterWhere(['like', 'serv.description', $this->description])
            // подключаем поиск по полю city.name
            ->andFilterWhere(['LIKE', 'city.name', $this->getAttribute('city.name')]);

        return $dataProvider;
    }
}
