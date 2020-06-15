<?php

class Email extends CActiveRecord {

    public $verifyCode; //验证码属性

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
            array('verifyCode', 'required', 'message' => '验证码必填'),
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
            array('email', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params) {
        $mem_info = Mem::model()->find("email=:email", array(":email" => $this->email));
        if (empty($mem_info)) {
            $this->addError('email', '对不起,没有该会员邮箱');
        }
    }

    public function attributeLabels() {
        return array(
            'email' => '邮箱',
            'verifyCode' => '验证码',
        );
    }

}
