<?php

/*
 * 宝箱模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Chests extends CActiveRecord {
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
        return '{{chests}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('ljhlb', 'required', 'message' => '请填写达到元宝！'),
            array('ljhlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '达到元宝填写数字！'),
            array('hlb', 'required', 'message' => '请填写奖励元宝！'),
            array('hlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励元宝只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'ljhlb' => '达到元宝',
            'hlb' => '奖励元宝',
        );
    }

}
