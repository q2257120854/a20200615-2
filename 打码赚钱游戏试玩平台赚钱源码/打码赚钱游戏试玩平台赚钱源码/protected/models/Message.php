<?php

/*
 * 资讯模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Message extends CActiveRecord {
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
        return '{{message}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
            array('title', 'required', 'message' => '请填写标题！'),
            array('content', 'required', 'message' => '请填写内容！'),
            array('author', 'required', 'message' => '请填写作者！'),
            array('message_type_id', 'required', 'message' => '请填写问题类型！'),
            array('is_official', 'required', 'message' => '你选择是否首页显示！'),
            array('is_hpage', 'required', 'message' => '你选择是否官方消息！'),
            array('is_recommend', 'required', 'message' => '你选择是否官方消息！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'color' => '标题颜色',
            'title' => '标题',
            'content' => '内容',
            'author' => '作者',
            'click' => '点击',
            'is_official' => '官方消息',
            'message_type_id' => '问题类型',
            'is_hpage' => '首页显示',
            'is_recommend' => '推荐',
        );
    }

    public function nextpost($pid) {
        return self::model()->find("message_type_id=:message_type_id and id>:id order by id ASC ", array(":message_type_id" => $pid, ":id" => $this->id));
    }

    public function prevpost($pid) {
        return self::model()->find("message_type_id=:message_type_id and id<:id order by id DESC ", array(":message_type_id" => $pid, ":id" => $this->id));
    }

    //会员中心官方消息
    public function nextpost2() {
        return self::model()->find("is_official=:is_official  and id>:id order by id ASC ", array(":id" => $this->id, ":is_official" => 1));
    }

    //会员中心官方消息
    public function prevpost2() {
        return self::model()->find("is_official=:is_official  and id<:id order by id DESC ", array(":id" => $this->id, ":is_official" => 1));
    }

}
