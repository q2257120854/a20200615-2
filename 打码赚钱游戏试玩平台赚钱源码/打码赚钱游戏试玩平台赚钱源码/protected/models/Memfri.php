<?php

class Memfri extends CActiveRecord {

    public $verifyCode; //验证码属性
    public $pwd2;
    private $_identity;

    /*
     * 返回当前模型对象的静态方法
     * 重写父类CActiveRecord对应的方法
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 返回当前数据表的名字
     *  重写父类CActiveRecord对应的方法
     */

    public function tableName() {
        return '{{mem}}';
    }

    public function rules() {
        return array(
            array('email', 'required', 'message' => '邮箱必填'),
            array('email', 'email', 'allowEmpty' => FALSE, 'message' => '邮箱格式不正确！'),
            array('email', 'unique', 'message' => '邮箱已经注册'),
            array('pwd', 'required', 'message' => '密码必填'),
            array('pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '太长了，密码最大只能有32位', 'tooShort' => '太短了了，密码最少需要有6位'),
            array('pwd2', 'required', 'message' => '确认密码必填'),
            array('pwd2', 'compare', 'compareAttribute' => 'pwd', 'message' => '两次密码必须一致'),
            array('mem_name', 'required', 'message' => '昵称必填'),
            array('mem_name', 'unique', 'message' => '昵称已经存在'),
            array('verifyCode', 'required', 'message' => '验证码必填'),
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
            array('email', 'authenticate'),
        );
    }
    
    
    public function authenticate($attribute, $params) {
        $num = Mem::model()->countBySql("select count(*) from {{mem}} where  TO_DAYS(create_time) = TO_DAYS(NOW()) and ip='" . $this->ip."'");
        if (!empty($num)) {
            $this->addError('email', '对不起,24小时内不能重复注册了!');
        }
        
    }

    public function attributeLabels() {
        return array(
            'email' => '邮箱',
            'pwd' => '密码',
            'pwd2' => '确认密码',
            'qq' => 'QQ账号',
            'sina' => '新浪账号',
            'mem_name' => '昵称',
            'name' => '姓名',
            'sex' => '性别',
            'id_code' => '身份证',
            'phone' => '手机',
            'address_id' => '发货地址',
            'pid' => '上级好友',
            'roll' => '角色',
            'verifyCode' => '验证码',
            'alipayid' => '支付宝id',
            'bankid' => '银行id',
            'treasureid' => '财付通id',
             'ip'=>"注册ip"
            
         
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->pwd = $this->encypt($this->pwd);
            }
            return true;
        } else {
            return false;
        }
    }

    //给密码进行md5加密
    public function encypt($pass) {
        return md5($pass);
    }

    public function login() {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->pwd);
            $this->_identity->authenticates();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else {
            return false;
        }
    }

}
