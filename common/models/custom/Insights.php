<?php

namespace common\models\custom;

use Yii;

/**
 * This is the model class for table "insights".
 *
 * @property string $id
 * @property string $model_id
 * @property integer $followers
 * @property integer $gained_followers
 * @property integer $lost_followers
 * @property integer $follows
 * @property integer $listed
 * @property integer $number_of_posted_media
 * @property integer $total_likes
 * @property integer $total_comments
 * @property integer $total_shares
 * @property integer $total_reactions
 * @property integer $total_interactions
 * @property integer $total_mentions
 * @property integer $total_views
 * @property integer $total_dislikes
 * @property integer $total_organic_reach
 * @property integer $total_paid_reach
 * @property integer $total_unpaid_reach
 * @property string $insights_json
 * @property string $created
 * @property string $updated
 *
 * @property Model $model
 */
class Insights extends \common\models\base\Base
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_id'], 'required'],
            [['model_id', 'followers', 'gained_followers', 'lost_followers', 'follows', 'listed', 'number_of_posted_media', 'total_likes', 'total_comments', 'total_shares', 'total_reactions', 'total_interactions', 'total_mentions', 'visits', 'checkins', 'total_views', 'total_dislikes', 'total_organic_reach', 'total_paid_reach', 'total_unpaid_reach'], 'integer'],
            [['insights_json'], 'string'],
			[['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'followers' => 'Followers',
            'gained_followers' => 'Gained Followers',
            'lost_followers' => 'Lost Followers',
            'follows' => 'Follows',
            'listed' => 'Listed',
            'number_of_posted_media' => 'Number Of Posted Media',
            'total_likes' => 'Total Likes',
            'total_comments' => 'Total Comments',
            'total_shares' => 'Total Shares',
            'total_reactions' => 'Total Reactions',
            'total_interactions' => 'Total Interactions',
            'total_mentions' => 'Total Mentions',
            'total_views' => 'Total Views',
            'total_dislikes' => 'Total Dislikes',
            'total_organic_reach' => 'Total Organic Reach',
            'total_paid_reach' => 'Total Paid Reach',
            'total_unpaid_reach' => 'Total Unpaid Reach',
            'visits' => 'Visits',
            'checkins' => 'Checkins',
			'insights_json' => 'Insights Json',
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
