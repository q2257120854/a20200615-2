<?php

/*
 * 站内消息模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Vipmessage extends CActiveRecord {
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
        return '{{vipmessage}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('title', 'required', 'message' => '请填写标题！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'title' => '标题',
            'content' => '内容',
            'vipmessage_type' => '消息类型',
            'mem_id' => '会员id',
            'is_read' => '是否阅读',
        );
    }

    public function nextpost($pid ,$mem_id) {
        $id = $this->id;
        $vipmessage_info = Vipmessage::model()->findByPk($id);
        $vipmessage_info["is_read"] = 1; //标记为以读
        $vipmessage_info->update();
        return self::model()->find("mem_id=:mem_id and vipmessage_type=:vipmessage_type and id>:id order by id ASC ", array(":vipmessage_type" => $pid, ":id" => $id, ":mem_id" => $mem_id));
    }

    public function prevpost($pid,$mem_id) {
        $id = $this->id;
        $vipmessage_info = Vipmessage::model()->findByPk($id);
        $vipmessage_info["is_read"] = 1; //标记为以读
        $vipmessage_info->update();
        return self::model()->find("mem_id=:mem_id and  vipmessage_type=:vipmessage_type and id<:id order by id DESC ", array(":vipmessage_type" => $pid, ":id" => $id, ":mem_id" => $mem_id));
    }

}
