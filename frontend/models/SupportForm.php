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
    public $name;
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
            [['name', 'mobile', 'support', 'message'], 'required'],
            [['mobile'], 'integer', 'min' => 10],
            [['name'], 'string', 'min' => 3, 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
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
			$email = $this->getSupportEmail($this->support);
            return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setTextBody($this->message)
            ->send();
    }
	
	public function getSupportEmail($support_type){
		switch($support_type){
			case self::FEEDBACK :
				$support_email = Yii::$app->params['feedbackEmail'];
				break;
			case self::TECHNICALSUPPORT :
				$support_email = Yii::$app->params['technicalSupportEmail'];
				break;
			case self::COMPLAINT :
				$support_email = Yii::$app->params['complaintEmail'];
				break;
		}
		return $support_email;
	}
    
}
