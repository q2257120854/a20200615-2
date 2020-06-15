<?php

/*
 * 招募游戏模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 将数据表相关内容以类的形式展现
 */

class Gamewamilazm extends CActiveRecord {
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
        return '{{game_wamila_zm}}';
    }



    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'mem_id' => '会员id',
            'tid' => '订单号',
            'tname' => '任务名称',
			'gold' => '元宝',
			'sign' => '秘钥',
            'ctime' => '时间',
            'create_time ' => '时间',
        );
    }

}
