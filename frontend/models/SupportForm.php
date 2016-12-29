<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\custom\User;

/**
 * ContactForm is the model behind the contact form.
 */
class SupportForm extends Model
{
    public $email;
    public $mobile;
    public $support;
    public $message;
    public $verifyCode;
	
	const FEEDBACK = 0;
    const TECHNICALSUPPORT = 1;
    const COMPLAINT = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'mobile', 'support', 'message'], 'required'],
            [['mobile'], 'integer', 'min' => 10],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'support' => 'Support',
            'message' => 'Message',
        ];
    }

    
    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendSupportEmail() {
            return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['supportEmail'])
            ->setFrom($this->email)
            ->setSubject('Support Message')
            ->setTextBody($this->message)
            ->send();
    }

}
