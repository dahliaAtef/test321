<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "recent_followers".
 *
 * @property string $id
 * @property string $model_id
 * @property string $followers_json
 * @property string $created
 * @property string $updated
 *
 * @property Model $model
 */
class RecentFollowers extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recent_followers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id', 'followers_json'], 'required'],
            [['model_id'], 'integer'],
            [['followers_json'], 'string'],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'followers_json' => Yii::t('app', 'Followers Json'),
            'created' => 'Created',
            'updated' => 'Updated'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'model_id']);
    }
}
