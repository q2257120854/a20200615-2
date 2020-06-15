<?php

class Meminfo extends CActiveRecord {
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
            array('mem_name', 'required', 'message' => '昵称必填'),
            array('mem_name', 'unique', 'message' => '昵称已经存在'),
        );
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
            'idcode' => '身份证',
            'phone' => '手机',
            'address_id' => '发货地址',
            'pid' => '好友上线',
            'role' => '会员类型', //普通会员、站长
            'verifyCode' => '验证码',
            'alipayid' => '支付宝id',
            'bankid' => '银行id',
            'treasureid' => '财付通id',
            'sign' => '连续签到',
        );
    }

   

}
