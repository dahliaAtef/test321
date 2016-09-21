<?php

/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 12.03.15
 * Time: 2:11
 */

namespace digi\metaTags\models;

use Yii;
use digi\metaTags\MetaTags;

class MetaTag extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            'TimestampBehavior' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return string the associated database table name
     */
    public static function tableName() {
        return '{{%meta_tags}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return [
            [['model', 'model_id'], 'required'],
            [['model_id'], 'integer'],
            [['description'], 'string'],
            [['model', 'title', 'keywords'], 'string', 'max' => 255],
            [['model', 'model_id', 'title', 'keywords', 'description', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return [
            'title' => MetaTags::t('messages', 'model_title'),
            'keywords' => MetaTags::t('messages', 'model_keywords'),
            'description' => MetaTags::t('messages', 'model_description'),
        ];
    }

}
