<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Content represents the model behind the search form about `common\models\base\Content`.
 */
class Page extends \common\models\custom\Page {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'type', 'sort', 'status'], 'integer'],
            [['title', 'slug', 'brief', 'description', 'body', 'date', 'end_date', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = parent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'sort' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => parent::TYPE,
            'date' => $this->date,
            'end_date' => $this->end_date,
            'sort' => $this->sort,
            'status' => $this->status,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'slug', $this->slug])
                ->andFilterWhere(['like', 'brief', $this->brief])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'body', $this->body]);

        return $dataProvider;
    }

}
