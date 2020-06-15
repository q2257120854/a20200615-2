<?php

/*
 * 金豆模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Hld extends CActiveRecord {
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
        return '{{hld}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('hld', 'required', 'message' => '请填写金豆！'),
            array('mem_id', 'required', 'message' => '请填写所属会员！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'hld' => '金豆',
            'reason' => '原因',
            'mem_id' => '会员',
            'source' => '来源',
            'type' => '类型',
        );
    }

}
