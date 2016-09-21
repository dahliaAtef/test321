<?php

namespace common\models\base;

use Yii;
use yii\helpers\Url;
use common\helpers\MediaHelper;

/**
 * This is the model class for table "base_media".
 *
 * @property integer $id
 * @property integer $model_id
 * @property string $model
 * @property string $path
 * @property string $filename
 * @property string $mime
 * @property integer $size
 * @property string $title
 * @property string $description
 * @property string $link
 * @property string $embed
 * @property integer $status
 * @property integer $type
 * @property integer $sort
 * @property string $created
 * @property string $updated
 */
class Media extends Base {

    /**
     * @var $uploadedFile instance of \yii\web\UploadedFile
     */
    public $uploadedFile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%base_media}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['path', 'filename', 'mime', 'size'], 'required'],
            [['model_id', 'size', 'status', 'type', 'sort'], 'integer'],
            [['description', 'embed'], 'string'],
            [['created', 'updated'], 'safe'],
            [['model'], 'string', 'max' => 64],
            [['path', 'title', 'link'], 'string', 'max' => 255],
            [['filename', 'mime'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'model_id' => 'Model ID',
            'model' => 'Model',
            'path' => 'Path',
            'filename' => 'File Name',
            'mime' => 'Mime Type',
            'size' => 'Size',
            'title' => 'Title',
            'description' => 'Description',
            'link' => 'Link',
            'embed' => 'Embed',
            'status' => 'Status',
            'type' => 'Type',
            'sort' => 'Sort',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    public function behaviors() {
        return array_merge_recursive(parent::behaviors(), [
            'Sortable' => [
                'class' => \digi\sortable\behaviors\Sortable::className(),
                'query' => static::find(),
                'orderAttribute' => 'sort'
            ],
        ]);
    }

    public static function find() {
        //Set default condition
        return parent::find()->orderBy(['sort' => SORT_ASC, 'id' => SORT_DESC]);
    }

    public function afterSave($insert, $changedAttributes) {
        if (!$insert) {
            if (!empty($changedAttributes['filename'])) {
                $path = !empty($changedAttributes['path']) ? $changedAttributes['path'] : $this->path;
                MediaHelper::deleteFiles(Yii::getAlias('@root') . $path, $changedAttributes['filename'], true);
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {
        //Delete files from the server
        MediaHelper::deleteFiles(Yii::getAlias('@root') . $this->path, $this->filename, true);
        return parent::afterDelete();
    }

    //////////////// Custom Functions ////////////////////

    /**
     * Retrieves mime list
     */
    public static function getMimeList() {
        return [
            'image' => Yii::t('app', 'Image'),
            'video' => Yii::t('app', 'Video'),
            'audio' => Yii::t('app', 'Audio'),
            'pdf' => Yii::t('app', 'PDF'),
            'application' => Yii::t('app', 'Other')
        ];
    }

    /**
     * @param string $sub the sub directory of the file (the size in case of images).
     * @param bool $absolute whether to get absolute or relative path
     * @return string path to the file 
     */
    public function getFilePath($sub = null, $absolute = true) {
        return Yii::getAlias($absolute ? '@root' : '') . $this->path . ($sub ? $sub . '/' : '') . $this->filename;
    }

    /**
     * @param string $sub the sub directory of the file (the size in case of images).
     * @param bool|string $scheme
     * @return string url to the file.
     */
    public function getFileUrl($sub = null, $scheme = true) {
        return Url::to($this->getFilePath($sub, false), $scheme);
    }

    /**
     * @param string $size from image config
     * @param bool|string $placeholder from image config
     * @param bool $overwrite
     * @return string url to the img using MediaHelper in order to generate the size. 
     */
    public function getImgUrl($size = null, $placeholder = true, $overwrite = false) {
        return MediaHelper::getImgUrl($this, $size, $placeholder, $overwrite);
    }

}
