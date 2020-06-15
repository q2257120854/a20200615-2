<?php

/*
 * 站长模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Web extends CActiveRecord {

    public $verifyCode;

    /*
     * 返回当前模型对象的静态方法
     */

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * 返回当前模型的名字
     */

    public function tableName() {
        //xm 前缀去掉
        return '{{web}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('webname', 'required', 'message' => '请填写网站名称！'),
            array('weburl', 'required', 'message' => '请填写网站地址！'),
            array('qq', 'required', 'message' => '请填写qq！'),
            array('qq', 'match', 'pattern' => '/^[0-9]*$/', 'message' => 'qq只能填写数字！'),
            array('phone', 'required', 'message' => '请填写手机！'),
            array('phone', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '手机只能填写数字！'),
            array('phone', 'unique', 'message' => '该手机已经申请过了'),
            array('email', 'required', 'message' => '请填写邮箱！'),
            array('name', 'required', 'message' => '请填写真实姓名！'),
            array('code', 'required', 'message' => '请填写身份证！'),
            array('code', 'unique', 'message' => '该身份证已经申请过了'),
            array('verifyCode', 'captcha', 'message' => '请输入正确的验证码'),
          
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'cl_time' => '审批时间',
            'webname' => '网站名称',
            'weburl' => '网站地址',
            'qq' => 'qq',
            'phone' => '手机',
            'email' => '邮箱',
            'name' => '真实姓名',
            'code' => '身份证',
            'mem_id' => '会员id',
            'status' => '状态',
            'remark' => '备注',
        );
    }

}
