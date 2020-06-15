<?php

//广告体验
class ExpadController extends Controller {

    function actionShow() {
        $sql = "SELECT * ,SUM(b.level_jlhlb) as hlb from (select * from {{exp_ad_data}} as a where date_format(create_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m') ) as b group by b.mem_id order by SUM(b.level_jlhlb) desc ";
        $data = array();
        $expaddata_model = Expaddata::model();
        $mem_model = Mem::model();
        $rank_model = Rank::model();
        $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=2  and start='已开启' order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=2 and start='已开启' order by grade ");
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $expadinfo = $expaddata_model->findBySql($sql . " limit " . $index . ",1");
            $memname = $mem_model->findByPk($expadinfo["mem_id"])->mem_name;
            $data[$index][0] = $num;
            $data[$index][1] = mb_substr($memname, 0, 4, 'utf-8') . '**';
            $data[$index][2] = number_format(intval($expadinfo["hlb"]));
            $data[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }
        $this->renderPartial('show', array("data" => json_encode($data), "count" => $count));
    }

    //数据自动更新页面
    function actionDetailzd($id) {
        $expad_model = Expad::model();
        $expad_info = $expad_model->findByPk($id);
        //广告未开始
        $begin = $expad_model->countBySql("select count(*) from {{exp_ad}} where  id=" . $id . " and begin_time < now()");
        if (empty($begin)) {
            Yii::app()->user->setFlash('msg', "对不起，该广告将在" . $expad_info["begin_time"] . "上线，敬请期待！");
            $this->renderPartial('msg');
            return;
        }
        //广告已结束
        $end = $expad_model->countBySql("select count(*) from {{exp_ad}} where  id=" . $id . " and TO_DAYS(end_time) >= (TO_DAYS(NOW())-3)");
        if (empty($end)) {
            Yii::app()->user->setFlash('msg', '对不起，此广告已下线，请体验其他广告！');
            $this->renderPartial('msg');
            return;
        }
        $this->renderPartial('detailzd', array("expad_info" => $expad_info));
    }

    //广告体验新注册接口
    function actionZcinfo() {
        try {
            $expad_model = Expad::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['hlz_uid']) || empty($_GET['hlz_expid']) || empty($_GET['expad_uid']) || empty($_GET['username']) || empty($_GET['hlz_cid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //此广告不存在
            $expad_num = $expad_model->countBySql("select count(*) from {{exp_ad}} where  id=" . $_GET['hlz_expid']);
            if (empty($expad_num)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $expad_model->countBySql("select count(*) from {{exp_ad}} where cid=" . $_GET['hlz_cid'] . " and id=" . $_GET['hlz_expid'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['hlz_uid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }
            //此账号已经绑定过
            $expadzm_num = Expadzm::model()->countBySql("select count(*) from {{exp_ad_zm}} where  exp_ad_id=" . $_GET['hlz_expid'] . " and userid=" . $_GET['expad_uid']);
            if (!empty($expadzm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            }
            //注册
            $expadzm_model = new Expadzm();
            $expadzm_model->mem_id = $_GET['hlz_uid'];
            $expadzm_model->userid = $_GET['expad_uid'];
            $expadzm_model->username = $_GET['username'];
            $expadzm_model->exp_ad_id = $_GET['hlz_expid'];
            //传递成功
            if ($expadzm_model->save()) {
                $returnmsg_model->reason = 0;
                $returnmsg_model->save();
                echo json_encode(array("start" => 0));
                return;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //广告等级查询
    function actionSelgrade() {
        try {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $mem = $this->show_mem();
                $expid = Yii::app()->request->getParam('expid'); //、广告id
                $expuid = Yii::app()->request->getParam('expuid');
                $expad_info = Expad::model()->findBySql("select * from {{exp_ad}} where id= " . $expid);
                $expadzm_info = Expadzm::model()->findBySql("select * from {{exp_ad_zm}} where mem_id=" . $mem["id"] . " and userid=" . $expuid);
                if (!empty($expad_info["key"])) {
                    if (!empty($expad_info["selgrade_type"])) {
                        $url = $expad_info['return_url'] . $expad_info['expad_uid'] . "=" . $expadzm_info["username"] . "&sign=" . md5($expuid . $expad_info["key"]);
                    } else {
                        $url = $expad_info['return_url'] . $expad_info['expad_uid'] . "=" . $expuid . "&sign=" . md5($expuid . $expad_info["key"]);
                    }
                } else {
                    if (!empty($expad_info["selgrade_type"])) {
                        $url = $expad_info['return_url'] . $expad_info['expad_uid'] . "=" . $expadzm_info["username"] ;
                    } else {
                        $url = $expad_info['return_url'] . $expad_info['expad_uid'] . "=" . $expuid;
                    }
                }
                $temp = file_get_contents($url);
                if (!empty($expad_info["json_layout"])) {
                    $result = json_decode($temp);
                    $data = $result->$expad_info["json_layout"];
                } else {
                    if ($expid == 100) {
                        $result = substr(str_replace(";", ",", $temp), 1, -2);
                        $result2 = str_replace(":", '":"', $result);
                        $result3 = '{"' . str_replace(",", '","', $result2) . '"}';
                        $data = json_decode($result3);
                    } else {
                        $data = json_decode($temp);
                    }
                }
                if (!empty($expad_info["selgrade_result"])) {
                    if (!empty($data->$expad_info["selgrade_result"]) && $data->$expad_info["selgrade_result"] != $expad_info["selgrade_succ"]) {
                        echo $data->$expad_info["selgrade_result"];
                    }
                }
                $expadgrade_model = Expadgrade::model();
                $expadgradedata_model = Expadgradedata::model();
                $expadgrade_info = $expadgrade_model->findAllBySql("select * from {{exp_ad_grade}} where exp_ad_id= " . $expid);
                if (!empty($expadgrade_info)) {
                    foreach ($expadgrade_info as $expadgrade) {
                        if ($data->$expadgrade["param"] == "true") {  //$data->$expadgrade["param"]为true表示步骤完成
                            $count = $expadgradedata_model->countBySql("select count(*) from {{exp_ad_gradedata}} where  mem_id=" . $mem["id"] . " and exp_ad_id=" . $expid . " and level='" . $expadgrade["param"] . "'");
                            if (empty($count)) {
                                $expadgradedata_model = new Expadgradedata();
                                $expadgradedata_model->level = $expadgrade["param"];
                                $expadgradedata_model->mem_id = $mem["id"];
                                $expadgradedata_model->hlb = $expadgrade["hlb"];
                                $expadgradedata_model->exp_ad_id = $expid;
                                $expadgradedata_model->save();
                                //奖励元宝
                                $title = "广告体验项目[" . $expad_info["name"] . "]";
                                $content = $title . "，完成" . $expadgrade["content"] . "获得奖励" . $expadgrade["hlb"] . "元宝 ！";
                                $this->updhlb($expadgrade["hlb"], 4, $content, $mem["id"], 0);
                                if (!empty($expadgrade["hlb"])) {
                                    $this->sendmessage($title, $content, 1, $mem["id"]);
                                }
                            }
                            //上级会员奖励
                            $mem_info = Mem::model()->findByPk($mem["id"]);
                            if (!empty($mem_info["pid"])) {
                                $array = explode(",", $mem_info["pid"]);
                                $n = count($array);
                                $j = 1;
                                for ($i = ($n - 2); $i >= 0; $i--) {
                                    if ($j == 1 || $j == 2 || $j == 3 || $j == 4) {
                                        $system_info = System::model()->findByPk(1);
                                        if ($j == 1) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzexpad1'];
                                                $title3 = $expad_info["name"] . " 站长1级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['expad1'];
                                                $title3 = $expad_info["name"] . " 1级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            }
                                        } else if ($j == 2) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzexpad2'];
                                                $title3 = $expad_info["name"] . " 站长2级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['expad2'];
                                                $title3 = $expad_info["name"] . " 2级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            }
                                        } else if ($j == 3) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzexpad3'];
                                                $title3 = $expad_info["name"] . " 站长3级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['expad3'];
                                                $title3 = $expad_info["name"] . " 3级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            }
                                        } else if ($j == 4) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzexpad4'];
                                                $title3 = $expad_info["name"] . " 站长4级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['expad4'];
                                                $title3 = $expad_info["name"] . " 4级好友(" . $mem_info["mem_name"] . ")领取体验奖励";
                                            }
                                        }
                                        $hlbsum = $expadgrade["hlb"] * ($rewadsmemhlb / 100);
                                        $content3 = $title3 . "奖" . $hlbsum . "元宝";
                                        $this->updhlb($hlbsum, 4, $content3, $array[$i], $mem["id"]);
                                        if (!empty($hlbsum)) {
                                            $this->sendmessage($title3, $content3, 1, $array[$i]);
                                        }
                                    }
                                    $j++;
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //数据手动更新
    function actionDetailsd($id) {
        $expad_info = Expad::model()->findByPk($id);
        $this->renderPartial('detailsd', array("expad_info" => $expad_info));
    }

    //数据手动提交
    function actionDataaudit() {
        $expad_info = Expad::model()->findByPk($_POST['expadid']);
        $expadaudit_model = new Expadaudit();
        $expadaudit_model->code = (String) substr(date("ymdHis"), 2, 8) . mt_rand(100000, 999999);
        $expadaudit_model->mem_id = $_POST['memid'];
        $expadaudit_model->exp_ad_id = $_POST['expadid'];
        $expadaudit_model->username = $_POST['username'];
        $expadaudit_model->start = "审核中";
        $expadaudit_model->hlb_num = $expad_info['rewards_hlb'];
        if ($expadaudit_model->save()) {
            $result = "success";
        } else {
            $result = "error";
        }
        $this->renderPartial('detailsd', array("expad_info" => $expad_info, "result" => $result));
    }

}
