<?php

//签到
class SignController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'sign'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 展示
     */

    function actionShow() {
        $memid = $this->show_mem_id();
        $mem = Mem::model()->findByPk($memid);
        $sign_model = Sign::model();
        $num1 = $sign_model->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and mem_id=" . $memid); //计算连续签到的次数
        $num2 = $sign_model->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id=" . $memid); //今天签到
        if (empty($num1) && empty($num2)) {
            $mem->sign = 0;
            $mem->update();
        }
        $this->renderPartial('show');
    }

    /*
     * 签到
     */

    function actionSign() {
        if (Yii::app()->request->isAjaxRequest) {
            $memid = Yii::app()->request->getParam('memid');
            $sign_model = new Sign();
            $sign_model->mem_id = $memid;
            if ($sign_model->save()) {
                $num = Sign::model()->countBySql("select count(*) from {{sign}} where TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and mem_id=" . $memid); //计算连续签到的次数
                $mem = Mem::model()->findByPk($memid);
                if (empty($num)) {//计算连续签到的次数
                    $mem->sign = 1;
                } else {
                    $mem->sign = $mem["sign"] + 1;
                }
                $mem->update();
                $sign = $mem["sign"];
                //签到额外奖励
                $reward = 0;
                if ($sign == 5) {
                    $reward = 50;
                } else if ($sign == 10) {
                    $reward = 100;
                } else if ($sign == 20) {
                    $reward = 300;
                } else if ($sign == 30) {
                    $reward = 500;
                }
                if ($sign == 31) {//清零
                    $mem->sign = 0;
                    $mem->update();
                }

                if (!empty($reward)) {
                    $title5 = "累计签到" . $sign . "天";
                    $content5 = $title5 . "，获得奖励" . $reward . "元宝";
                    $hlb_model = $this->updhlb($reward, 11, $content5, $memid, 0); //元宝
                    if (!empty($reward)) {
                        $this->sendmessage($title5, $content5, 1, $memid);
                    }
                }
                $hlbnum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $memid);
                $hldnum = Hld::model()->countBySql("select sum(hld) from {{hld}} where mem_id=" . $memid);
                $reward11 = intval($hlbnum * 0.0003); //签到奖励计算公式
                $reward21 = intval($hldnum * 0.0002);
                $reward12 = 0;
                $reward22 = 0;
                $system_info = System::model()->findByPk(1);
                if ($hlbnum >= $system_info["sign_rand_hlb"]) {
                    //签到奖励
                    if ($sign == 1) {
                        $reward12 = intval($hlbnum * 0.00001); //连续签到奖励计算公式
                    } else if ($sign == 2) {
                        $reward12 = intval($hlbnum * 0.00002); //连续签到奖励计算公式
                    } else if ($sign == 3) {
                        $reward12 = intval($hlbnum * 0.00003); //连续签到奖励计算公式
                    } else if ($sign == 4) {
                        $reward12 = intval($hlbnum * 0.00004); //连续签到奖励计算公式
                    } else if ($sign == 5) {
                        $reward12 = intval($hlbnum * 0.00005); //连续签到奖励计算公式
                    } else if ($sign == 6) {
                        $reward12 = intval($hlbnum * 0.00006); //连续签到奖励计算公式
                    } else if ($sign == 7) {
                        $reward12 = intval($hlbnum * 0.00007); //连续签到奖励计算公式
                    } else if ($sign == 8) {
                        $reward12 = intval($hlbnum * 0.00008); //连续签到奖励计算公式
                    } else if ($sign == 9) {
                        $reward12 = intval($hlbnum * 0.00009); //连续签到奖励计算公式
                    } else if ($sign >= 10) {
                        $reward12 = intval($hlbnum * 0.0001); //连续签到奖励计算公式
                    }
                } else {
                    $reward12 = rand(2, 5); //随机奖励元宝
                }

                if ($hldnum >= $system_info["sign_rand_hld"]) {
                    //签到奖励
                    if ($sign == 1) {
                        $reward22 = intval($hldnum * 0.00001);
                    } else if ($sign == 2) {
                        $reward22 = intval($hldnum * 0.00002);
                    } else if ($sign == 3) {
                        $reward22 = intval($hldnum * 0.00003);
                    } else if ($sign == 4) {
                        $reward22 = intval($hldnum * 0.00004);
                    } else if ($sign == 5) {
                        $reward22 = intval($hldnum * 0.00005);
                    } else if ($sign == 6) {
                        $reward22 = intval($hldnum * 0.00006);
                    } else if ($sign == 7) {
                        $reward22 = intval($hldnum * 0.00007);
                    } else if ($sign == 8) {
                        $reward22 = intval($hldnum * 0.00008);
                    } else if ($sign == 9) {
                        $reward22 = intval($hldnum * 0.00009);
                    } else if ($sign >= 10) {
                        $reward22 = intval($hldnum * 0.0001);
                    }
                } else {
                    $reward22 = rand(2, 5); //随机奖励金豆
                }
                $rewardhlb = $reward11 + $reward12;
                $rewardhld = $reward21 + $reward22;
                $title = "于" . date("Y-m-d H:i:s", time()) . "签到成功";
                $content1 = $title . "，获得奖励" . $rewardhlb . "元宝";
                $content2 = $title . "，获得奖励" . $rewardhld . "金豆";
                $content3 = $title . "，获得奖励" . $rewardhlb . "元宝和" . $rewardhld . "金豆";

                $hlb_model = $this->updhlb($rewardhlb, 11, $content1, $memid, 0); //元宝
                $hld_model = $this->updhld($rewardhld, 2, $content2, $memid); //金豆
                $this->sendmessage($title, $content3, 1, $memid);
                //存入元宝id
                $sign_model->hlb_id = $hlb_model["id"];
                $sign_model->hld_id = $hld_model["id"];
                $sign_model->update();
                echo $rewardhlb . "*" . $rewardhld; //获得奖励
            } else {
                echo $sign_model->getError("mem_id");
            }
        }
    }

}
