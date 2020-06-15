<?php

class Idcode extends CActiveRecord {

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
            array('name', 'required', 'message' => '真实姓名必填'),
            array('idcode', 'required', 'message' => '身份证必填'),
            array('idcode', 'unique', 'message' => '身份证已被认证'),
            array('verifyCode', 'required', 'message' => '验证码必填'),
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
        );
    }

    public function attributeLabels() {
        return array(
            'name' => '真实姓名',
            'idcode' => '身份证',
            'verifyCode' => '验证码',
        );
    }

}
