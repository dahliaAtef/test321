<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\custom\Competitors as CompetitorsModel;

/**
 * Competitors represents the model behind the search form about `common\models\custom\Competitors`.
 */
class Competitors extends CompetitorsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'comp_no'], 'integer'],
			[['created', 'updated'], 'safe'],
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
        $query = CompetitorsModel::find();

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
            'user_id' => $this->user_id,
            'comp_no' => $this->comp_no,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}
