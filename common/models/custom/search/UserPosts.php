<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\custom\UserPosts as UserPostsModel;

/**
 * UserPosts represents the model behind the search form about `common\models\custom\UserPosts`.
 */
class UserPosts extends UserPostsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'page_model_id'], 'integer'],
            [['creation_time', 'created', 'updated', 'message', 'post_id'], 'safe'],
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
        $query = UserPostsModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'page_model_id' => $this->page_model_id,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'creation_time', $this->creation_time])
                ->andFilterWhere(['like', 'message', $this->message])
                ->andFilterWhere(['like', 'post_id', $this->post_id]);

        return $dataProvider;
    }
}
