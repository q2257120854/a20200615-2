<?php

class Memsecond extends CActiveRecord {

    public $code; //验证码属性
    public $code2; //短信验证码属性

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
            array('phone', 'required', 'message' => '请填写手机号码！'),
            array('phone', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '手机号码不正确！'),
            array('phone', 'unique', 'message' => '手机号码已经绑定了'),
            array('code', 'required', 'message' => '短信验证码必填'),
            array('code2', 'compare', 'compareAttribute' => 'code', 'message' => '短信验证码不正确'),
        );
    }
    

    public function attributeLabels() {
        return array(
            'phone' => '手机号码',
            'code' => '验证码',
        );
    }

}
