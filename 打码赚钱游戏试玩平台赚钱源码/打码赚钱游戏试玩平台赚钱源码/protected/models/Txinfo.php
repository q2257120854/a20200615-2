<?php

/*
 * 提现模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Txinfo extends CActiveRecord {
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
        return '{{tx}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '收款人',
            'way' => '收款方式', //收款方式 （1为银行 2为支付宝 3为财富通）
            'account' => '收款账号',
            'hlb_id' => 'hlb记录',
            'applymoney' => '提现金额',
            'fee' => '手续费',
            'rewards' => '奖励',
            'money' => '实付金额',
            'starts' => '状态', //状态（未处理，已处理,已驳回） 
            'remark' => '备注',
            'thlb_id' => '退回元宝',
        );
    }

}
