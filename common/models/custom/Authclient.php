<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "authclient".
 *
 * @property string $id
 * @property string $user_id
 * @property string $source
 * @property string $source_id
 * @property string $created
 * @property string $updated
 *
 * @property BaseUser $user
 */
class Authclient extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authclient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['source', 'source_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function setUserId($id)
    {
        $this->user_id = $id;
    }
    
    public function getModel()
    {
        return $this->hasMany(Model::className(), ['authclient_id' => 'id']);
    }
    
    public function getParentModel()
    {
        return $this->hasOne(Model::className(), ['authclient_id' => 'id'])->andWhere(['parent_id' => null]);
    }
}
