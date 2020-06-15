<?php

class Jypwd extends CActiveRecord {

    public $new_jy_pwd; //新密码
    public $old_jy_pwd; //旧密码
    public $code; //验证码属性
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
            array('old_jy_pwd', 'required', 'message' => '密码必填'),
            array('old_jy_pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '密码最长32位', 'tooShort' => '密码最短6位'),
            array('new_jy_pwd', 'required', 'message' => '密码必填'),
            array('new_jy_pwd', 'length', 'min' => '6', 'max' => '32', 'tooLong' => '密码最长32位', 'tooShort' => '密码最短6位'),
            array('jy_pwd', 'required', 'message' => '确认密码必填'),
            array('jy_pwd', 'compare', 'compareAttribute' => 'new_jy_pwd', 'message' => '两次密码必须一致'),
            array('code', 'required', 'message' => '邮箱验证码必填'),
            array('code', 'authenticate3'),
            array('old_jy_pwd', 'authenticate'),
        );
    }

    public function authenticate3($attribute, $params) {
        if ($this->num != $this->code) {
            $this->addError('code', '对不起,验证码不正确！');
        }
    }

    public function authenticate($attribute, $params) {
        $mem_info = Mem::model()->find("email=:email and jy_pwd=:jy_pwd", array(":email" => Yii::app()->user->name, ":jy_pwd" => md5($this->old_jy_pwd)));
        if (empty($mem_info)) {
            $this->addError('old_jy_pwd', '旧密码不对！');
        }
    }

    public function attributeLabels() {
        return array(
            'pwd' => '密码',
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
