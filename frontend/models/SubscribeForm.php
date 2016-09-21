<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\custom\User;

/**
 * ContactForm is the model behind the contact form.
 */
class SubscribeForm extends Model
{
    public $username;
    public $email;
    public $mobile;
    public $password;
    public $re_password;
    public $brand_name;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 're_password', 'mobile', 'brand_name'], 'required'],
            [['email'], 'email'],
			[['mobile'], 'integer', 'min' => 10],
            [['username'], 'string', 'min' => 3, 'max' => 64],
            [['email', 'password'], 'string', 'max' => 128],
            [['brand_name'], 'string', 'min' => 4, 'max' => 500],
            ['re_password', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message' => "Passwords don't match"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            're_password' => 'Re-Password',
            'mobile' => 'Mobile',
            'brand_name' => 'Brand Name',
        ];
    }

    
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function subscribe() {
            $oUser = new User();
            $oUser->username = $this->username;
            $oUser->status = User::STATUS_SUSPENDED;
            $oUser->setPassword($this->password);
            $oUser->generateAuthKey();
            $oUser->generateVerificationToken();
            $oUser->email = $this->email;
            $oUser->mobile = $this->mobile;
            $oUser->brand_name = $this->brand_name;
            if($oUser->save()){
                return $oUser;
            }
        return null;
    }
    
}
