<?php

/*
 * 几元任务模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Task extends CActiveRecord {
    
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
        return '{{task}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('game_name', 'required', 'message' => '请填写游戏名称！'),
            array('game_id', 'required', 'message' => '请填写游戏id！'),
            array('game_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '游戏id只能填写数字！'),
            array('grade', 'required', 'message' => '请填写领取奖励等级！'),
            array('grade', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '领取奖励等级只能填写数字！'),
            array('task_type', 'required', 'message' => '请选择任务类型！'),
            
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'game_name' => '游戏名称',
            'game_id' => '游戏id',
            'grade' => '领取奖励等级',
            'task_type' => '任务类型',
        );
    }

}
