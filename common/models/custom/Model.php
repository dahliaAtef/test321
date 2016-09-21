<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "model".
 *
 * @property string $id
 * @property string $authclient_id
 * @property integer $parent_id
 * @property string $entity_id
 * @property integer $type
 * @property string $name
 * @property string $content
 * @property string $media_url
 * @property integer $post_type
 * @property integer $in_reply_to_id
 * @property integer $likes
 * @property integer $comments
 * @property integer $shares
 * @property integer $interactions
 * @property integer $reactions
 * @property integer $followers
 * @property string $creation_time
 * @property string $url
 * @property string $source
 * @property string $tags
 * @property string $filter
 * @property string $created
 * @property string $updated
 *
 * @property Insights[] $insights
 * @property BaseUser $user
 */
class Model extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authclient_id', 'type', 'entity_id'], 'required'],
            [['authclient_id', 'parent_id', 'type', 'post_type', 'followers', 'likes', 'comments', 'shares', 'reactions', 'in_reply_to_id', 'interactions'], 'integer'],
            [['created', 'updated'], 'safe'],
            [[/*'creation_time',*/ 'filter', 'source', 'content'], 'string'],
            [['name'], 'string', 'max' => 150],
            [['media_url', 'url', 'tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'authclient_id' => 'Authclient ID',
            'parent_id' => 'Parent ID',
            'entity_id' => 'Entity ID',
            'type' => 'Type',
            'name' => 'Name',
            'content' => 'Content',
            'media_url' => 'Media Url',
            'post_type' => 'Post Type',
            'in_reply_to_id' => 'In Reply To ID',
            'likes' => 'Likes',
            'comments' => 'Comments',
            'shares' => 'Shares',
            'interactions' => 'Interactions',
            'reactions' => 'Reactions',
            'followers' => 'Followers',
            'creation_time' => 'Creation Time',
            'url' => 'Url',
            'source' => 'Source',
            'tags' => 'Tags',
            'filter' => 'Filter',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInsights()
    {
        return $this->hasMany(Insights::className(), ['model_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthclient()
    {
        return $this->hasOne(Authclient::className(), ['id' => 'authclient_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagramAuthclient()
    {
        return $this->hasOne(Authclient::className(), ['id' => 'authclient_id'])->andWhere(['source' => 'instagram']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecentFollowers()
    {
        return $this->hasOne(RecentFollowers::className(), ['model_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPosts()
    {
        return $this->hasMany(UserPosts::className(), ['page_model_id' => 'id']);
    }
}
