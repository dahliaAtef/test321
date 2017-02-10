<?php

namespace frontend\models;

use yii\base\Model;
use common\models\custom\User;
use common\helpers\MailHelper;

/**
 * Password reset request form
 */
class RequestPasswordResetForm extends Model {

    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::className(),
                'filter' => ['status' => User::STATUS_VERIFIED],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail() {
        /* @var $oUser User */
        $oUser = User::findOne([
                    'status' => User::STATUS_VERIFIED,
                    'email' => $this->email,
        ]);

        if ($oUser) {
            $oUser->generatePasswordResetToken();
            return $oUser->save() && MailHelper::sendPasswordResetToken($oUser);
        }

        return false;
    }

}
