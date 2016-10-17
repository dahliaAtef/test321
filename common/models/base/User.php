<?php

namespace common\models\base;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "base_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $token
 * @property integer $token_type
 * @property string $auth_key
 * @property string $sso_key
 * @property integer $status
 * @property string $last_login
 * @property string $created
 * @property string $updated
 */
class User extends Base implements IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_SUSPENDED = 1;
    const STATUS_VERIFIED = 2;
    const STATUS_BANNED = 3;
    const TOKEN_TYPE_VERIFY = 1;
    const TOKEN_TYPE_PASSWORD_RESET = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%base_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'email', 'password'], 'required'],
            //['email', 'email'],
            ['status', 'default', 'value' => self::STATUS_SUSPENDED],
            //['status', 'in', 'range' => [self::STATUS_VERIFIED, self::STATUS_DELETED]],
            [['token_type', 'status', 'mobile'], 'integer'],
            [['username'], 'string', 'min' => 3, 'max' => 64],
            [['email'], 'string', 'max' => 128],
            [['brand_name'], 'string', 'max' => 500],
            [['password', 'token', 'auth_key', 'sso_key'], 'string', 'max' => 123],
            [['email', 'token', 'auth_key', 'sso_key'], 'unique'],
            [['token', 'token_type', 'last_login', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            're_password' => 'Re-Password',
            'mobile' => 'Mobile',
            'brand_name' => 'Brand Name',
            'token' => 'Token',
            'token_type' => 'Tokent Type',
            'auth_key' => 'Auth Key',
            'sso_key' => 'Sso Key',
            'status' => 'Status',
            'last_login' => 'Last Login',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => self::STATUS_VERIFIED]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_VERIFIED]);
    }

    /**
     * Finds user by verification reset token
     *
     * @param string $token verification token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        $oUser = static::findOne([
                    'token' => $token,
                    'token_type' => self::TOKEN_TYPE_VERIFY,
                    'status' => self::STATUS_SUSPENDED,
        ]);

        return ($oUser && static::isValidToken($oUser->token, Yii::$app->params['user.verificationTokenExpire'])) ? $oUser : null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        $oUser = static::findOne([
                    'token' => $token,
                    'token_type' => self::TOKEN_TYPE_PASSWORD_RESET,
                    'status' => self::STATUS_VERIFIED,
        ]);

        return ($oUser && static::isValidToken($oUser->token, Yii::$app->params['user.passwordResetTokenExpire'])) ? $oUser : null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        //var_dump($password, $this->password);die;
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates verification token
     */
    public function generateVerificationToken() {
        $this->token = Yii::$app->security->generateRandomString() . '_' . time();
        $this->token_type = self::TOKEN_TYPE_VERIFY;
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->token = Yii::$app->security->generateRandomString() . '_' . time();
        $this->token_type = self::TOKEN_TYPE_PASSWORD_RESET;
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->token = null;
    }

    /**
     * Removes tokens
     */
    public function removeTokens() {
        $this->token = $this->token_type = null;
    }

    /**
     * Restes password
     * @param string $password
     * @return bool
     */
    public function resetPassword($password) {
        $this->setPassword($password);
        $this->removeTokens();
        return $this->save(false);
    }

    /**
     * Verify 
     * @param string $password
     * @return bool
     */
    public function verify() {
        $this->status = self::STATUS_VERIFIED;
        $this->removeTokens();
        return $this->save(false);
    }

    /**
     * Retrieves status list
     */
    public static function getStatusList() {
        return [
            self::STATUS_SUSPENDED => Yii::t('app', 'Suspended'),
            self::STATUS_VERIFIED => Yii::t('app', 'Verified'),
            self::STATUS_BANNED => Yii::t('app', 'Banned'),
        ];
    }

}
