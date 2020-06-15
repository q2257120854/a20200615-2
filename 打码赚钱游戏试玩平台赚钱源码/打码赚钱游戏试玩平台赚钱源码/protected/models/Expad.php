<?php

/*
 * 体验广告管理模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Expad extends CActiveRecord {
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

        return '{{exp_ad}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
//            array('name', 'required', 'message' => '请填写游戏名称！'),
//            array('img', 'required', 'message' => '请上传缩略图！'),
//            array('image', 'required', 'message' => '请上传详情页图片！'),
//            array('updtime', 'required', 'message' => '请填写审核周期！'),
//            array('explain', 'required', 'message' => '请填写广告说明！'),
//            array('rewards_hlb', 'required', 'message' => '每人奖励不能为空！'),
//            array('rewards_hlb', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '每人奖励只能填写数字！'),
//            array('recruit_num', 'required', 'message' => '招募人数不能为空！'),
//            array('recruit_num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '招募人数只能填写数字！'),
//            array('ask', 'required', 'message' => '请填写体验要求！'),
//            array('course', 'required', 'message' => '请填写体验教程！'),
//            array('orderby', 'required', 'message' => '请填写排序！'),
//            array('orderby', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '排序只能填写数字！'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'name' => '名称',
            'img' => '缩略图',
            'image' => '详情页图片',
            'explain' => '广告说明',
            'rewards_hlb' => '每人奖励',
            'recruit_num' => '招募人数',
            'recruit_num_bs' => '招募倍数',
            'is_timely' => '数据返还',
            'ask' => '体验要求',
            'course' => '体验教程链接',
            'login_url' => '登录地址',
            'register_url' => '注册地址',
            'return_url' => '回调地址',
            'content' => '步骤内容',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'describe' => '领取方式',
            'updtime' => '审核周期',
            'open' => '状态',
            'zm_start' => '招募状态',
            'hlz_uid' => '、玩家会员ID参数名',
            'expad_uid' => '等级查询传递广告账号参数名',
            'json_level' => '返回广告等级参数',
            'json_layout' => '返回的json格式参数',
            'bustype' => '广告商',
            'zc_end_time' => '注册结束时间',
            'hlz_uid' => '注册传递会员账号参数名',
            'hlz_expid' => '注册传递广告id参数名',
            'expad_uid' => '阶梯查询传递广告账号参数名',
            'key' => '阶梯查询传递key参数名',
            'selgrade_type' => '阶梯查询方式',
            'selgrade_result' => '阶梯查询结果返回参数',
            'selgrade_succ' => '阶梯查询成功返回值',
        );
    }

}
