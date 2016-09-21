<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\custom\Model as ModelModel;

/**
 * Model represents the model behind the search form about `common\models\custom\Model`.
 */
class Model extends ModelModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authclient_id', 'parent_id', 'type', 'post_type', 'followers', 'likes', 'comments', 'shares', 'reactions', 'in_reply_to_id'], 'integer'],
            [['name', 'media_url', 'created', 'url', 'tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = ModelModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'type' => $this->type,
            'post_type' => $this->post_type,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'media_url', $this->media_url])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}
