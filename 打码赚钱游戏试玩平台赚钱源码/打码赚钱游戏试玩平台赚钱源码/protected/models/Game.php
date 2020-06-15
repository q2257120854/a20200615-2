<?php

/*
 * 游戏模型
 * model()创建一个模型对象
 * tableName()返回当前数据表的名字
 * CActiveRecord 是活跃记录，好多成熟框架都有此技术
 * 元宝
 */

class Game extends CActiveRecord {
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
        return '{{game}}';
    }

    /*
     * 实现验证
     */

    public function rules() {
        return array(
//            array('name', 'required', 'message' => '请填写游戏名称！'),
//            array('gamerange', 'required', 'message' => '请填写试玩范围！'),
//            array('img', 'required', 'message' => '请上传专栏展图！'),
//            array('business', 'required', 'message' => '请填写游戏提供商！'),
//            array('businessimg', 'required', 'message' => '请上传游戏提供商图片！'),
//            array('logoimg', 'required', 'message' => '请上传游戏logo！'),
//            array('recruit_num', 'required', 'message' => '招募人数不能为空！'),
//            array('recruit_num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '招募人数只能填写数字！'),
//            array('cz_rewards_num', 'required', 'message' => '充值返利不能为空！'),
//            array('cz_rewards_num', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '充值返利只能填写数字！'),
//            array('login_url', 'required', 'message' => '登录地址不能为空！'),
//            array('register_url', 'required', 'message' => '注册地址不能为空！'),
//            array('return_url', 'required', 'message' => '回调地址不能为空！'),
//            array('bg_img', 'required', 'message' => '请上传游戏背景图片！'),
//            array('game_type_id', 'required', 'message' => '请选择游戏类型！'),
//            array('articleid', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '游戏文章id只能填写数字！'),
//            array('rewardsend_time', 'required', 'message' => '充值奖励发送不能为空！'),
//            array('rewardsend_time', 'match', 'pattern' => '/^[0-9]*$/', 'message' => '充值奖励发送天数只能填写数字！'),
//            array('introduce', 'required', 'message' => '游戏介绍不能为空！'),
//            array('photos1', 'required', 'message' => '请上传游戏截图1！'),
//            array('photos2', 'required', 'message' => '请上传游戏截图2！'),
//            array('photos3', 'required', 'message' => '请上传游戏截图3！'),
//            array('photos4', 'required', 'message' => '请上传游戏截图4！'),
//            array('begin_time', 'required', 'message' => '游戏开始不能为空'),
//            array('end_time', 'required', 'message' => '游戏结束不能为空'),
                //  array('gamezmbs', 'required', 'message' => '游戏招募人数倍数不能为空'),
        );
    }

    /*
     * 对应标签名称
     */

    function attributeLabels() {
        return array(
            'game_id' => '厂商游戏id',
            'notice' => '游戏重要需知',
            'img' => '专栏展图',
            'name' => '游戏名称',
            'gamerange' => '试玩范围',
            'color' => '背景颜色',
            'business' => '游戏商家',
            'businessimg' => '游戏商家图片',
            'bustype' => '游戏提供商',
            'logoimg' => '游戏logo',
            'is_timely' => '更新时间',
            'is_display' => '专题页显示',
            'is_prefecture' => '服务类型', //单服 多服 专区
            'is_hpage' => '首页显示',
            'is_new' => '新手任务显示',
            'is_sign' => '签到页显示',
            'begin_time' => '开始时间',
            'end_time' => '结束时间',
            'zc_end_time' => '注册结束时间',
            'game_type_id' => '游戏类型',
            'recruit_num' => '招募人数',
            'cz_rewards_num' => '充值返利',
            'czhref' => '充值链接',
            'login_url' => '登录地址',
            'register_url' => '注册地址',
            'return_url' => '等级刷新地址',
            'cz_hint' => '充值活动提示',
            'bg_img' => '游戏背景图片',
            'articleid' => '游戏文章id',
            'rewardsend_time' => '充值奖励发送',
            'introduce' => '游戏介绍',
            'photos1' => '游戏截图1',
            'photos2' => '游戏截图2',
            'photos3' => '游戏截图3',
            'photos4' => '游戏截图4',
            'photos5' => '游戏截图5',
            'photos6' => '游戏截图6',
            'photos7' => '游戏截图7',
            'photos8' => '游戏截图8',
            'zc_start' => '注册状态',
            'game_start' => '游戏状态',
            'valid' => '试玩状态',
            'gamezmbs' => '游戏招募人数倍数',
            'cid' => 'Cid',
            'zcreturn' => '注册回调',
            'hlz_uid' => '、网络玩家会员ID参数名',
            'json_layout' => '返回的json格式参数',
            'json_servername' => '返回游戏服区参数',
            'json_role' => '返回游戏角色参数',
            'json_level' => '返回游戏等级参数',
            'json_payment' => '返回游戏充值',
            'game_uid' => '等级查询传递游戏账号参数名',
            'impactcont' => '冲击比赛说明',
            'networklevel' => '联网冲级比赛等级参数',
            'networknickname' => '联网冲级比赛昵称参数',
            'networkuptime' => '联网冲级比赛更新时间参数',
            'networkurl' => '自定义跳转链接',
            'impactmax' => '冲级赛最大奖励',
            'hlz_gid_valid' => '注册链接是否带上gid',
        );
    }

}
