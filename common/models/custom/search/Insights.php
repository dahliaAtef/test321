<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\custom\Insights as InsightsModel;

/**
 * Insights represents the model behind the search form about `common\models\custom\Insights`.
 */
class Insights extends InsightsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'model_id', 'followers', 'follows', 'listed', 'number_of_posted_media', 'total_likes', 'total_comments', 'total_mentions', 'visits', 'checkins', 'total_views', 'total_dislikes', 'total_organic_reach', 'total_paid_reach', 'total_unpaid_reach'], 'integer'],
            [['created', 'insights_json'], 'safe'],
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
        $query = InsightsModel::find();

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
            'model_id' => $this->model_id,
            'followers' => $this->followers,
            'follows' => $this->follows,
            'number_of_posted_media' => $this->number_of_posted_media,
            'total_likes' => $this->total_likes,
            'total_comments' => $this->total_comments,
            'total_views' => $this->total_views,
            'total_dislikes' => $this->total_dislikes,
            'total_organic_reach' => $this->total_organic_reach,
            'total_paid_reach' => $this->total_paid_reach,
            'total_unpaid_reach' => $this->total_unpaid_reach,
            'visits' => $this->visits,
            'checkins' => $this->checkins,
            'created' => $this->created,
        ]);
		
		$query->andFilterWhere(['like', 'insights_json', $this->insights_json]);

        return $dataProvider;
    }
}
