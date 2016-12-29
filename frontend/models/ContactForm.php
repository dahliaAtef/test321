<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $email;
    public $phone;
    public $message;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['email', 'phone', 'message'], 'required'],			
			[['email'], 'email'],			
			[['phone'], 'integer', 'min' => 10],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',			'email' => 'Email',			'phone' => 'Mobile',			'message' => 'Message',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {	
     	return Yii::$app->mailer->compose('contact', ['model' => $this])
          	->setFrom($this->email)
            ->setTo($email)
          	->setSubject('Contact-us Message')
            ->setTextBody($this->message)
            ->send();
    }
}
