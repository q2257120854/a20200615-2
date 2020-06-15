<?php

/*
 * 兑换模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Giftdh extends CActiveRecord {
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
        return '{{gift_dh}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('gift_id', 'required', 'message' => '请填写礼品id！'),
            array('name', 'required', 'message' => '请填写礼品名称！'),
            array('consignee', 'required', 'message' => '请填写收货人名称！'),
            array('province', 'required', 'message' => '请填写省份！'),
            array('city', 'required', 'message' => '请填写城市！'),
            array('address', 'required', 'message' => '请填写地址！'),
            array('phone', 'required', 'message' => '请填写手机号码！'),
            array('phone', 'match', 'pattern' => '/^1\d{10}$/', 'message' => '手机号码不正确！'),
            array('tel', 'match', 'pattern' => '((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)', 'message' => '手机号码格式不正确'),
            array('memqq', 'required', 'message' => '联系QQ不能为空！'),
            array('memqq', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '联系QQ只能填写数字！'),
            array('mem_id', 'required', 'message' => '会员id 不能为空！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '礼品名称',
            'gift_id' => '礼品id',
            'hld' => '所用金豆',
            'hld_id' => '消耗金豆记录',
            'starts' => '兑换状态',//兑换中，已兑换，已拒绝
            'phone' => '手机号码',
            'tel' => '电话',
            'consignee' => '收货人',
            'province' => '省份',
            'city' => '城市',
            'district' => '县',
            'address' => '发货地址',
            'memqq' => '会员QQ',
            'remark' => '备注',
            'mem_id' => '所属会员',
            'mem_name' => '会员昵称',
            'dh_time' => '同意时间',
        );
    }

  

}
