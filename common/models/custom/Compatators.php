<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "compatators".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $comp_no
 *
 * @property CompChannels[] $compChannels
 * @property BaseUser $user
 */
class Compatators extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compatators';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'comp_no'], 'required'],
            [['id', 'user_id', 'comp_no'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'comp_no' => Yii::t('app', 'Comp No'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompChannels()
    {
        return $this->hasMany(CompChannels::className(), ['comp_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BaseUser::className(), ['id' => 'user_id']);
    }
}
