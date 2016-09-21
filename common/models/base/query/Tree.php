<?php

namespace common\models\base\query;


class Tree extends \yii\db\ActiveQuery {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            \creocoder\nestedsets\NestedSetsQueryBehavior::className(),
        ];
    }

}
