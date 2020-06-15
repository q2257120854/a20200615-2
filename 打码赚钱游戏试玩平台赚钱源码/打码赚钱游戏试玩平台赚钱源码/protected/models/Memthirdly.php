<?php

class Memthirdly extends CActiveRecord {

    public $code; //邮箱验证码属性
    public $num; //系统产生验证码

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
            array('code', 'required', 'message' => '邮箱验证码必填'),
            array('num', 'compare', 'compareAttribute' => 'code', 'message' => '邮箱验证码不正确'),
        );
    }

    public function attributeLabels() {
        return array(
            'email' => '邮箱',
            'code' => '邮箱验证码',
        );
    }

}
