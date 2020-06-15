<?php

/*
 * 冲级比赛模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Gameimpact extends CActiveRecord {
    
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
        return '{{game_impact}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('rank', 'required', 'message' => '请填写排名！'),
            array('rank', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '排名只能填写数字！'),
            array('level', 'required', 'message' => '请填写等级！'),
            array('level', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '等级只能填写数字！'),
            array('hlb', 'required', 'message' => '请填写奖励元宝！'),
            array('hlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '奖励元宝只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'rank' => '排名',
            'level' => '等级',
            'game_id' => '游戏id',
            'hlb' => '奖励元宝',
            'hlb_id' => '领取元宝id',
            'mem_id' => '会员id',
            'valid' => '是否领取',
        );
    }

}
