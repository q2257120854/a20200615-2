<?php

/*
 * 排行管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Rank extends CActiveRecord {
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
        return '{{rank}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('grade', 'required', 'message' => '请填写排名！'),
            array('grade', 'match','pattern'=>'/^[0-9]*$/', 'message' => '排名只能填写数字！'),
            array('name', 'required', 'message' => '请填写排名名称！'),
            array('rewards_hlb', 'required', 'message' => '请填写奖励元宝！'),
            array('rewards_hlb', 'match','pattern'=>'/^[0-9]*$/', 'message' => '奖励元宝只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'grade' => '排名',
            'name' => '排名名称',
            'rewards_hlb' => '奖励元宝',
            'rank_type' => '类型',
            'start' => '状态',
        );
    }

}
