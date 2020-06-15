<?php

class Memfourthly extends CActiveRecord {

    public $jy_pwd2; //2交易密码
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
            array('jy_pwd', 'required', 'message' => '密码必填'),
            array('jy_pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '密码最长32位', 'tooShort' => '密码最短6位'),
            array('jy_pwd2', 'required', 'message' => '确认密码必填'),
            array('jy_pwd2', 'compare', 'compareAttribute' => 'jy_pwd', 'message' => '两次密码必须一致'),
            array('verifyCode', 'required', 'message' => '验证码必填'),
            array('verifyCode', 'captcha', 'message' => '验证码不对'),
        );
    }

    public function attributeLabels() {
        return array(
            'jy_pwd' => '交易密码',
            'verifyCode' => '验证码',
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->jy_pwd = $this->encypt($this->jy_pwd);
            return true;
        } else {
            return false;
        }
    }

    //给密码进行md5加密
    public function encypt($pass) {
        return md5($pass);
    }

}
