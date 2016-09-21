<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class UserPagesForm extends Model
{
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // id is required
            [['id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

}
