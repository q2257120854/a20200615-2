<?php

class Memfirst extends CActiveRecord {
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
            array('qq', 'required', 'message' => 'QQ号码必填'),
            array('qq', 'match', 'pattern' => '/^[0-9]*$/', 'message' => 'QQ号码只能填写数字！'),
            array('name', 'required', 'message' => '真实姓名必填'),
            array('idcode', 'required', 'message' => '身份证必填'),
            array('idcode', 'unique', 'message' => '身份证已被认证'),
          
        );
    }

    public function attributeLabels() {
        return array(
            'qq' => 'QQ号码',
            'name' => '姓名',
            'idcode' => '身份证号码',
        );
    }

}
