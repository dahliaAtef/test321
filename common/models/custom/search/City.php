<?php

namespace common\models\custom\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Tree represents the model behind the search form about `common\models\base\Tree`.
 */
class City extends \common\models\custom\City {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
            [['name', 'slug', 'link', 'description', 'icon', 'created', 'updated'], 'safe'],
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
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'root' => $this->root,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'lvl' => $this->lvl,
            'icon_type' => $this->icon_type,
            'active' => $this->active,
            'selected' => $this->selected,
            'disabled' => $this->disabled,
            'readonly' => $this->readonly,
            'visible' => $this->visible,
            'collapsed' => $this->collapsed,
            'movable_u' => $this->movable_u,
            'movable_d' => $this->movable_d,
            'movable_l' => $this->movable_l,
            'movable_r' => $this->movable_r,
            'removable' => $this->removable,
            'removable_all' => $this->removable_all,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'slug', $this->slug])
                ->andFilterWhere(['like', 'link', $this->link])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }

}
