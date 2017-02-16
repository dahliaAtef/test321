<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * RangeForm is the model behind the range form.
 */
class RangeForm extends Model
{	
    public $start_date;
    public $end_date;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

}
