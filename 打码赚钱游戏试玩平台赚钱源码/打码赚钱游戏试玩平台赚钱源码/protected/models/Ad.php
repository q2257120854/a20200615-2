<?php

/*
 * 广告模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Ad extends CActiveRecord {
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
        return '{{ad}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('name', 'required', 'message' => '请填写广告名称！'),
            array('url', 'required', 'message' => '请填写链接地址！'),
            array('ad_type_id', 'required', 'message' => '请选择类型！'),
            array('orderby', 'required', 'message' => '顺序不能为空！'),
            array('orderby', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '顺序只能填写数字！'),
            array('img', 'required', 'message' => '请上传缩略图！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'img' => '缩略图',
            'name' => '广告名称',
            'url' => '链接地址',
            'ad_type_id' => '类型',
            'hlb_num' => '奖励元宝',
            'orderby' => '顺序',
            'open' => '状态',
        );
    }

}
