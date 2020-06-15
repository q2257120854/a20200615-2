<?php

class Logpwd extends CActiveRecord {

    public $newpwd; //新密码
    public $oldpwd; //旧密码
    public $code; //邮箱验证码
    public $num; //验证码属性

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
            array('oldpwd', 'required', 'message' => '密码必填'),
            array('oldpwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '密码最长32位', 'tooShort' => '密码最短6位'),
            array('pwd', 'required', 'message' => '密码必填'),
            array('pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '密码最长32位', 'tooShort' => '密码最短6位'),
            array('newpwd', 'required', 'message' => '确认密码必填'),
            array('newpwd', 'compare', 'compareAttribute' => 'pwd', 'message' => '两次密码必须一致'),
            array('code', 'required', 'message' => '邮箱验证码必填'),
            array('code', 'authenticate3'),
        );
    }

    public function authenticate3($attribute, $params) {
        if ($this->num != $this->code) {
            $this->addError('code', '对不起,验证码不正确！');
        }
    }

   

    public function attributeLabels() {
        return array(
            'pwd' => '密码',
            'code' => '邮箱验证码',
        );
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            $this->pwd = $this->encypt($this->pwd);
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
