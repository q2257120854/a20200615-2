<?php

class AccountLoginForm extends CFormModel {

    public $username;
    public $password;
    public $verifyCode; //验证码属性
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            // username and password are required
            array('username', 'required', 'message' => '用户名必填'),
            array('password', 'required', 'message' => '密码必填'),
            array('verifyCode', 'required', 'message' => '验证码必填'),
            //对验证码进行校验
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
            //校验用户名和密码的真实性,通过自定义方法实现校验
            array('password', 'authenticate1'),
            array('password', 'authenticate2'),
        );
    }

    public function authenticate1($attribute, $params) {
        $account_info = Account::model()->find("username=:username and valid=1 ", array(":username" => $this->username));
        if (!empty($account_info)) {
            $this->addError('password', '账号被禁用');
        }
    }

    public function authenticate2($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate2()) {
                $this->addError('password', '用户名或密码不正确');
            }
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'username' => '用户名',
            'password' => '密  码',
            'verifyCode' => '验证码',
                //'rememberMe'=>'记住登录状态',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate2();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->admin->login($this->_identity, $duration);
            return true;
        } else
            return false;
    }

}
