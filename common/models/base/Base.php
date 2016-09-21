<?php
namespace common\models\base;

use Yii;
use yii\helpers\StringHelper;
use common\helpers\MediaHelper;

class Base extends \yii\db\ActiveRecord {

    /** @var string slug pattern  */
    const SLUG_PATTERN = '/^[a-z0-9]+(?:-[a-z0-9]+)*$/'; // '/^[0-9a-z-]{0,128}$/';
    /** @var string phone pattern */
    const PHONE_PATTERN = '/^[\d\s-\+\(\)]+$/';

    public function behaviors() {
        return [
            'TimestampBehavior' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'MetaTag' => [
                'class' => \digi\metaTags\MetaTagBehavior::className(),
            ],
        ];
    }

    /**
     * Global Media hasMany Relation
     */
    public function getMedia() {
        return $this->hasMany(\common\models\custom\Media::className(), ['model_id' => 'id'])->andWhere(['model' => StringHelper::basename(static::className())]); //->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }

    /**
     * Global Media hasOne Relation
     */
    public function getFirstMedia() {
        return $this->hasOne(\common\models\custom\Media::className(), ['model_id' => 'id'])->andWhere(['model' => StringHelper::basename(static::className())]); //->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }
    
    public function getFirstPdf() {
        return $this->hasOne(\common\models\custom\Media::className(), ['model_id' => 'id'])->andWhere(['model' => StringHelper::basename(static::className())])->andWhere(['mime' => 'application/pdf']); //->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }
    
    public function getFirstImg(){
        return $this->hasOne(\common\models\custom\Media::className(), ['model_id' => 'id'])->andWhere(['model' => StringHelper::basename(static::className())])->andWhere(['like','mime','image/']);
    }
    
    /**
     * Gets retlted featured image url ex: $oArticle->getFeaturedImgUrl().
     */
    public function getFeaturedImgUrl($size = null, $placeholder = true, $overwrite = false) {
        return $this->firstMedia ? $this->firstMedia->getImgUrl($size, $placeholder, $overwrite) : MediaHelper::getPlaceholderUrl($size, $placeholder, $overwrite);
    }
    
    /**
     * Gets retlted image url by index ex:
     * $oArticle->getImgUrlByIndex(2) => gets the third article image. 
     */
    public function getImgUrlByIndex($index, $size = null, $placeholder = true, $overwrite = false) {
        return ($this->media && !empty($this->media[$index])) ? $this->media[$index]->getImgUrl($size, $placeholder, $overwrite) : MediaHelper::getPlaceholderUrl($size, $placeholder, $overwrite);
    }

    /**
     * Finds out if token is valid
     * @param string $token
     * @param timestamp $expire
     * @return bool
     */
    public static function isValidToken($token, $expire) {
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

}
