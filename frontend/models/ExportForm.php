<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ExportForm is the model behind the range form.
 */
class ExportForm extends Model
{	
    public $images_id;
    public $images_src;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['images_id', 'images_src'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'images' => 'Images',
        ];
    }

}
