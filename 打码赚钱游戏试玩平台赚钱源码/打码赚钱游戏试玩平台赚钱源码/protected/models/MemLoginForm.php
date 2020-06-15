<?php

class MemLoginForm extends CFormModel {

    public $email;
    public $pwd;
    public $verifyCode; //验证码属性
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('email', 'required', 'message' => '邮箱必填'),
            array('pwd', 'required', 'message' => '密码必填'),
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
            array('pwd', 'authenticate1'),
            array('pwd', 'authenticate2'),
        );
    }

    public function authenticate1($attribute, $params) {
        $mem_info = Mem::model()->find("email=:email and valid=1 ", array(":email" => $this->email));
        if (!empty($mem_info)) {
            $this->addError('pwd', '账号被禁用');
        }
    }

    public function authenticate2($attribute, $params) {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->email, $this->pwd);
            if (!$this->_identity->authenticate()) {
                $this->addError('pwd', '用户名或密码不正确');
            }
        }
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'email' => '用户名',
            'pwd' => '密  码',
            'verifyCode' => '验证码',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login() {
      
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->pwd);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            // $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else {
            return false;
        }
    }

}
