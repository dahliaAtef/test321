<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use common\models\base\form\Login;
use common\models\base\form\ChangePassword;
use common\models\custom\User;
use common\models\custom\Profile;
use common\models\custom\Users;
use common\models\custom\Authclient;
use frontend\models\RequestPasswordResetForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * User controller
 */
class UserController extends \frontend\components\BaseController {

    public function actions() {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except' => ['auth'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login', 'verify', 'request-password-reset', 'reset-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'login' => ['post'],
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin() {
        $oLoginForm = new Login();
        if ($oLoginForm->load(Yii::$app->request->post()) && $oLoginForm->login()) {
           // var_dump($oLoginForm->username);die;
           $id=  Yii::$app->user->getId() ;
           $userObj= \common\models\base\User::findByUserId($id);
            Yii::$app->session->set('ActiveUser', $userObj->username);

            return $this->redirect(Url::to(['/dashboard/'.$userObj->username]));
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, wrong email or password. Please try again.'));
            return $this->goBack(); //$this->goHome();
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup() {
        $oSignupForm = new SignupForm();
        if ($oSignupForm->load(Yii::$app->request->post())) {
            if ($oUser = $oSignupForm->signup()) {
                if (\common\helpers\MailHelper::sendVerificationToken($oUser)) {
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));
                    return $this->goHome();
                } else {
                    Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, error sendin email.'));
                    $oUser->delete();
                }
            }
        }

        return $this->render('signup', [
                    'oSignupForm' => $oSignupForm,
        ]);
    }
	
    public function actionChangePassword()
    {
        $oChangePassword = new ChangePassword();
        if ($oChangePassword->load(Yii::$app->request->post()) && $oChangePassword->validate()) {
            $oUser = User::findOne(Yii::$app->user->getId());
            if ($oUser->resetPassword($oChangePassword->new_password)) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your password has been reset.'));
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset your password.'));
            }
        }

        return $this->render('changePassword', [
                    'oChangePassword' => $oChangePassword,
        ]);
    }
    
    public function actionVerify($token) {

        $oUser = User::findByVerificationToken($token);
        
        if ($oUser && $oUser->verify()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Congratulations, your account verified successfully.'));
            Yii::$app->getUser()->login($oUser);
        } else
            throw new InvalidParamException(Yii::t('app', 'Wrong verification token.'));

        return $this->goHome();
    }

    public function actionRequestPasswordReset() {
        $oRequestPasswordResetForm = new RequestPasswordResetForm();
        if ($oRequestPasswordResetForm->load(Yii::$app->request->post()) && $oRequestPasswordResetForm->validate()) {
            if ($oRequestPasswordResetForm->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Check your email for further instructions.'));

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, we are unable to reset password for email provided.'));
            }
        }

        return $this->render('requestPasswordReset', [
                    'oRequestPasswordResetForm' => $oRequestPasswordResetForm,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $oResetPasswordForm = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($oResetPasswordForm->load(Yii::$app->request->post()) && $oResetPasswordForm->validate() && $oResetPasswordForm->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'New password has been saved.'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'oResetPasswordForm' => $oResetPasswordForm,
        ]);
    }

    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     * @todo enhancements
     * @reference http://www.yiiframework.com/doc-2.0/guide-security-auth-clients.html
     * @param yii\authclient\ClientInterface $client
     * @return boolean|yii\web\Response
     */
    public function onAuthSuccess($client) {
        $attributes = $client->api('me?fields=id,name,email,picture.type(large)', 'GET'); // $client->getUserAttributes();
        
        $oAuthClient = Authclient::find()->where([
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ])->one();

        if (!empty($attributes['email'])) {

            if (Yii::$app->user->isGuest) {
                if ($oAuthClient) { // login
                    Yii::$app->user->login($oAuthClient->user);
                } else { // signup
                    if (User::find()->where(['email' => $attributes['email']])->exists()) {
                        Yii::$app->getSession()->setFlash('error', Yii::t('app', "You can't sign in with Facebook account ({email}) as you're already registered by our normal sign up process. You can use normal sign in or forgot password.", ['email' => $attributes['email']]));
                    } else {
                        $oUser = new User();
                        $oProfile = new Profile();
                        $oAuthClient = new Authclient();
                        $oUser->username = $oUser->email = $attributes['email'];
                        $oUser->status = User::STATUS_VERIFIED;
                        $oUser->setPassword(Yii::$app->security->generateRandomString(6));
                        $oUser->generateAuthKey();
                        $oProfile->first_name = $attributes['name'];
                        $oAuthClient->source = $client->getId();
                        $oAuthClient->source_id = $attributes['id'];
                        $oDBTransaction = Yii::$app->db->beginTransaction();
                        if ($oUser->save() && $oProfile->setUserId($oUser->id) && $oProfile->save(false) && $oAuthClient->setUserId($oUser->id) && $oAuthClient->save()) {
                            $oDBTransaction->commit();
                            if(!empty($attributes['picture']['data']['url'])) {
                                $oMedia = new \common\models\base\Media();
                                $oMedia->model = 'User';
                                $oMedia->model_id = $oUser->id;
                                \common\helpers\MediaHelper::urlUpload($oMedia, $attributes['picture']['data']['url']);
                            }
                            Yii::$app->user->login($oUser);
                        } else {
                            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, error saving data.'));
                            $oDBTransaction->rollBack();
                        }
                    }
                }
            } else { // user already logged in
                if (!$oAuthClient) { // add auth provider
                    $oAuthClient = new Authclient([
                        'user_id' => Yii::$app->user->id,
                        'source' => $client->getId(),
                        'source_id' => $attributes['id'],
                    ]);
                    $oAuthClient->save();
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your authentication data saved successfully.'));
                }
            }
        } else {
            Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Sorry, no email found.'));
        }
    }

}
