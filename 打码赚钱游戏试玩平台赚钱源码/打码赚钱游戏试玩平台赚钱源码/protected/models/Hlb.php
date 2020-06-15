<?php

/*
 * 元宝模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Hlb extends CActiveRecord {

    public $hlbnum;

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
        return '{{hlb}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('type', 'required', 'message' => '请选择操作元宝类型！'),
            array('hlb', 'required', 'message' => '请填写操作元宝！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'hlb' => '元宝',
            'type' => '操作类型',
            'reason' => '原因',
            'source' => '来源',
            'mem_id' => '会员id',
            'pmem_id' => '来自推广会员', //用于打码,试玩,体验,好友邀请等提成, 来自关联会员的一些操作所赠送
        );
    }

}
