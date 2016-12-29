<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\custom\CompChannels as CompChannelsModel;

/**
 * CompChannels represents the model behind the search form about `common\models\custom\CompChannels`.
 */
class CompChannels extends CompChannelsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'comp_id', 'comp_channel_followers'], 'integer'],
            [['img_url', 'comp_channel', 'comp_channel_id', 'comp_channel_name', 'created', 'updated'], 'safe'],
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
        $query = CompChannelsModel::find();

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
            'comp_id' => $this->comp_id,
            'comp_channel_followers' => $this->comp_channel_followers,
          	'img_url' => $this->img_url,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'comp_channel', $this->comp_channel])
            ->andFilterWhere(['like', 'comp_channel_id', $this->comp_channel_id])
			->andFilterWhere(['like', 'comp_channel_name', $this->comp_channel_name]);

        return $dataProvider;
    }
}
