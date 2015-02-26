<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class fLogin extends CFormModel
{

    public $username;
    public $password;
    public $rememberMe = true;
    public $verifyCode;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return [
            ['verifyCode', 'captcha'],
            // username and password are required
            ['username, password', 'required'],
            // rememberMe needs to be a boolean
            ['rememberMe', 'boolean'],
            // password needs to be authenticated
            ['password', 'authenticate', 'skipOnError' => true],
            ['username', 'userexist', 'skipOnError' => true],
        ];
    }

    // 2. attach the behavior to LoginForm
    public function behaviors()
    {
        return [
            'smartCaptcha' => [
                'class' => 'SmartCaptchaBehavior',
                'numErrorBefore' => 2, // the number of errors allowed before first to show captcha.
                'numErrorAfter' => 5, // the number of errors allowed once pass captcha validation.
                'attributes' => null, // list of attributes whose error affects to show captcha. Defaults to null for all attributes.
            ],
        ];
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return [
            'rememberMe' => Yii::t('flogin', 'Remember Me'),
            'username' => Yii::t('flogin', 'User Name'),
            'password' => Yii::t('flogin', 'Password'),
        ];
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', 'Incorrect password...');
    }

    public function userexist($attribute, $params)
    {
        $user = sUser::model()->find('LOWER(username)=?', [strtolower($this->username)]);
        if ($user === null)
            $this->addError('username', 'not registered username... ');

        if ($user !== null && $user->status_id != 1)
            $this->addError('username', 'username has been de-activated...');
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 1 : 0; // 1 day Only
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

}
