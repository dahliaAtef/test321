<?php

namespace common\models\base\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * User represents the model behind the search form about `common\models\base\User`.
 */
class User extends \common\models\base\User {
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'token_type', 'status', 'mobile'], 'integer'],
            [['username', 'email', 'password', 'token', 'auth_key', 'sso_key', 'last_login', 'created', 'updated', 'brand_name'], 'safe'],
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
            'token_type' => $this->token_type,
            'status' => $this->status,
            'last_login' => $this->last_login,
            'mobile' => $this->mobile,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'brand_name', $this->brand_name])
                ->andFilterWhere(['like', 'token', $this->token])
                ->andFilterWhere(['like', 'auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'sso_key', $this->sso_key]);

        return $dataProvider;
    }

}
