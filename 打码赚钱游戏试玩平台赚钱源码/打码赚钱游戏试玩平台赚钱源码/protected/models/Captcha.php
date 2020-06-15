<?php

/*
 * 打码管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Captcha extends CActiveRecord {
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
        return '{{captcha}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写任务名称！'),
            array('qz', 'required', 'message' => '请填写工号前缀！'),
            array('code_val', 'required', 'message' => '请填写码值！'),
            array('ip', 'required', 'message' => '请选择是否换ip！'),
            array('jiesuan', 'required', 'message' => '请填写结算周期！'),
            array('resource', 'required', 'message' => '请选择资源是否充足！'),
            array('jiesuan', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '结算周期只能填写数字！'),
            array('down_url', 'required', 'message' => '请填写下载地址！'),
            array('return_url', 'required', 'message' => '请填写回调地址！'),
            array('introduce', 'required', 'message' => '请填写介绍！'),
            array('orderby', 'required', 'message' => '请填写排序！'),
            array('orderby', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '排序只能填写数字！'),
            array('ad_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '详情页引用广告id只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'ad_id' => '详情页引用广告id',
            'name' => '任务名称',
            'code_val' => '码值',
            'jiesuan' => '结算周期',
            'ip' => '类型',
            'resource' => '资源',
            'open' => '状态',
            'down_url' => '下载地址',
            'return_url' => '数据返还地址',
            'update_time' => '更新时间',
            'orderby' => '排序',
            'introduce' => '项目介绍',
            'is_display' => '专题页显示',
            'qz' => '工号前缀',
            'type' => '数据返回',
            'update_time' => '更新时间',
            'title2' => '副标题',
        );
    }

}
