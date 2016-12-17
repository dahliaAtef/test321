<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "competitors".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $comp_no
 * @property string $created
 * @property string $updated
 *
 * @property CompChannels[] $compChannels
 * @property BaseUser $user
 */
class Competitors extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competitors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'comp_no'], 'required'],
            [['user_id', 'comp_no'], 'integer'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'comp_no' => Yii::t('app', 'Comp No'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated')
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
  
  public function deleteCompetitors($ids){
    $ids_array = explode(",", $ids);
    foreach($ids_array as $id){
  		Competitors::findOne($id)->delete();
    }
  }
  
}
