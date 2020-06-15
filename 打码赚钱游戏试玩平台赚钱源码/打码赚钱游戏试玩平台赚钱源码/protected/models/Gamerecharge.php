<?php

/*
 * 充值返利模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Gamerecharge extends CActiveRecord {
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
        return '{{game_recharge}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('mem_id', 'required', 'message' => '请填写会员id！'),
            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
            array('game_id', 'required', 'message' => '请填写游戏名称！'),
            array('game_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '游戏名称只能填写数字！'),
            array('username', 'required', 'message' => '请填写游戏帐号！'),
            array('userserver', 'required', 'message' => '请填写游戏区服！'),
            array('gamename', 'required', 'message' => '请填写游戏名称！'),
            array('role', 'required', 'message' => '请填写游戏角色名称！'),
            array('level', 'required', 'message' => '请填写游戏等级！'),
            array('level', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '游戏等级只能填写数字！'),
            array('hlb', 'required', 'message' => '请填写元宝！'),
            array('hlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '元宝只能填写数字！'),
            
            array('hlb_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '元宝id只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'gamename' => '游戏名称',
            'username' => '游戏帐号',
            'role' => '游戏角色名称',
            'level' => '游戏等级',
            'userserver' => '游戏区服',
            'game_id' => '游戏id',
            'hlb' => '元宝',
            'hlb_id' => '元宝id',
            'mem_id' => '会员id',
        );
    }

}
