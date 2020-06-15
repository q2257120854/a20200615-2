<?php

/*
 * 凡凡元宝兑换记录模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Ybhld extends CActiveRecord {

    public $username2;

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
        return '{{ybrecord}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('username', 'required', 'message' => '请填写游戏账号！'),
            array('username2', 'required', 'message' => '请填写确认游戏账号！'),
            array('username2', 'compare', 'compareAttribute' => 'username', 'message' => '两次游戏账号必须一致'),
            array('username', 'authenticate'),
        );
    }

    public function authenticate() {
        $num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where gid=478 and  username='" . $this->username . "'");
        if (empty($num)) {
            $this->addError('username', '充值账号不存在！');
        }
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            "guid" => "游戏账号id",
            "username" => "游戏账号",
            "type" => "消耗类型",
            'gold' => '消耗数量',
            'goldid' => '消耗币id',
            'ybnum' => '兑换元宝数量',
            'mem_id' => '兑换会员',
            "status" => "充值状态"
        );
    }

}
