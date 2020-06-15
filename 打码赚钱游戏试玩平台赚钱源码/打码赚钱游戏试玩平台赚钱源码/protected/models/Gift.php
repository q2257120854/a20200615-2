<?php

/*
 * 奖品模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Gift extends CActiveRecord {
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
        return '{{gift}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写奖品名称！'),
            array('gift_type_id', 'required', 'message' => '请选择奖品类型！'),
            array('hld_num', 'required', 'message' => '请填写兑换金豆！'),
            array('hld_num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励金豆只能填写数字！'),
            array('img', 'required', 'message' => '请上传缩略图！'),
            array('introduce', 'required', 'message' => '请填写奖品介绍！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '奖品名称',
            'img' => '缩略图',
            'hld_num' => '兑换欢豆',
            'is_hpage' => '首页显示',
            'is_recommend' => '推荐奖品',
            'introduce' => '兑奖介绍',
            'gift_type_id' => '奖品类型',
            'exchange_num' => '已兑换数量',
        );
    }

}
