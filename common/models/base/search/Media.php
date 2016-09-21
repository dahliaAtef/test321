<?php

namespace common\models\base\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Media represents the model behind the search form about `common\models\base\Media`.
 */
class Media extends \common\models\base\Media {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'model_id', 'size', 'status', 'type', 'sort'], 'integer'],
            [['model', 'path', 'filename', 'mime', 'title', 'description', 'link', 'embed', 'created', 'updated'], 'safe'],
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
            'model_id' => $this->model_id,
            'model' => $this->model,
            'size' => $this->size,
            'status' => $this->status,
            'type' => $this->type,
            'sort' => $this->sort,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
                ->andFilterWhere(['like', 'filename', $this->filename])
                ->andFilterWhere(['like', 'mime', $this->mime])
                ->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'link', $this->link])
                ->andFilterWhere(['like', 'embed', $this->embed]);

        return $dataProvider;
    }

}
