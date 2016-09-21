<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property string $id
 * @property string $name
 * @property integer $count
 * @property string $created
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'count'], 'required'],
            [['count'], 'integer'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'count' => 'Count',
            'created' => 'Created',
        ];
    }
}
