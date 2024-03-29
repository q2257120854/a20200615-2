<?php

/*
 * 广告体验等级模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Expadgrade extends CActiveRecord {
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
        return '{{exp_ad_grade}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('grade', 'required', 'message' => '请填写等级！'),
            array('grade', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '等级只能填写数字！'),
            array('content', 'required', 'message' => '请填写步骤内容！'),
            array('hlb', 'required', 'message' => '请填写奖励元宝！'),
            array('hlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励元宝只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'grade' => '等级',
            'expad_id' => '广告体验id',
            'content' => '内容',
            'hlb' => '奖励元宝',
            'param' => '返回参数',
        );
    }

}
