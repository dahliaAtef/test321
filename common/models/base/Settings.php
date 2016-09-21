<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "base_settings".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 * @property string $description
 * @property string $created
 * @property string $updated
 */
class Settings extends Base {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'base_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['key', 'value'], 'required'],
            [['key'], 'string', 'max' => 64],
            [['value', 'description'], 'string', 'max' => 500],
            [['key'], 'unique'],
            [['created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

}
