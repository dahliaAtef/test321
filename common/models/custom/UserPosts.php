<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "user_posts".
 *
 * @property string $id
 * @property string $page_model_id
 * @property string $post_id
 * @property string $message
 * @property string $creation_time
 * @property string $created
 * @property string $updated
 *
 * @property Model $pageModel
 */
class UserPosts extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_model_id'], 'integer'],
            [['post_id'], 'required'],
            [['created', 'updated'], 'safe'],
            [['message'], 'string'],
            [['post_id'], 'string', 'max' => 100],
            //[['creation_time'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_model_id' => 'Page Model ID',
            'post_id' => 'Post ID',
            'creation_time' => 'Creation Time',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'page_model_id']);
    }
}
