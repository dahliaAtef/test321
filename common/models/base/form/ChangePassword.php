<?php

namespace common\models\base\form;

use Yii;
use yii\base\Model;
use common\models\base\User;

class ChangePassword extends Model {

    public $old_password;
    public $new_password;
    public $password_repeat;
    public $oUser;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return [
            [['old_password', 'new_password'], 'required'],
            ['old_password', 'ruleValidatePassword'],
            ['new_password', 'string', 'min' => 4],
            ['new_password', 'compare', 'operator' => '!=', 'compareAttribute' => 'old_password', 'message' => Yii::t('app', 'New Password must not be equal to Old Password')],
            [['password_repeat'], 'compare', 'compareAttribute' => 'new_password'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function ruleValidatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->oUser = User::findOne(Yii::$app->user->getId());
            ($this->oUser && $this->oUser->validatePassword($this->old_password)) or $this->addError($attribute, Yii::t('app', 'Wrong old password!'));
        }
    }

}
