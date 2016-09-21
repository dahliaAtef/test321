<?php

namespace common\models\custom;

use Yii;

class Media extends \common\models\base\Media {
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return array_merge_recursive(parent::rules(), [
            [['uploadedFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, gif, bmp', 'maxFiles' => 1, 'on' => 'uploadAvatar'],
        ]);
    }

}
