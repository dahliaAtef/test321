<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "comp_channels".
 *
 * @property integer $id
 * @property integer $comp_id
 * @property string $comp_channel
 * @property string $comp_channel_id
 * @property integer $comp_channel_followers
 *
 * @property Compatators $comp
 */
class CompChannels extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comp_channels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comp_id', 'comp_channel', 'comp_channel_id', 'comp_channel_followers'], 'required'],
            [['comp_id', 'comp_channel_followers'], 'integer'],
            [['comp_channel'], 'string', 'max' => 10],
            [['comp_channel_id'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'comp_id' => Yii::t('app', 'Comp ID'),
            'comp_channel' => Yii::t('app', 'Comp Channel'),
            'comp_channel_id' => Yii::t('app', 'Comp Channel ID'),
            'comp_channel_followers' => Yii::t('app', 'Comp Channel Followers'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp()
    {
        return $this->hasOne(Compatators::className(), ['id' => 'comp_id']);
    }
}
