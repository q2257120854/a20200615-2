<?php

/*
 * 游戏数据模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Gamedata extends CActiveRecord {

    public $grade;
    public $hlb;

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
        return '{{game_data}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
//            array('mem_id', 'required', 'message' => '请填写会员id！'),
//            array('mem_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '会员id只能填写数字！'),
//            array('game_id', 'required', 'message' => '请填写、游戏id！'),
//            array('game_id', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '、游戏id只能填写数字！'),
//            array('username', 'required', 'message' => '请填写游戏帐号！'),
//            array('role', 'required', 'message' => '请填写游戏角色名称！'),
//            array('level', 'required', 'message' => '请填写游戏等级！'),
//            array('level', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '游戏等级只能填写数字！'),
           
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'game_id' => '、网络游戏id',
            'guid' => '游戏账号id',
            'username' => '游戏帐号',
            'servername' => '游戏区服',
            'role' => '游戏角色名称',
            'level' => '游戏等级',
            'level_jlhlb' => '奖励元宝',
            'payment' => '总共充值金额',
            'valid' => "领取状态", //1表示领取了
        );
    }

}
