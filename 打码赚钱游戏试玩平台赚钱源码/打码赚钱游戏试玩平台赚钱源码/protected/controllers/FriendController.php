<?php

/*
 * 邀请好友
 */

class FriendController extends Controller {
    /*
     * 展示
     */

    function actionShow() {
        $rank_model = Rank::model();
        $mem_model = Mem::model();
        $hlb_model = Hlb::model();
        $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=5  and start='已开启' order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=5 and start='已开启'  order by grade ");
        if (date("Y-m") == "2015-04" || date("Y-m") == "2015-05") {
            $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  pmem_id !=0 and create_time  between  '2015-04-10 00:00' and '2015-05-31 23:59' GROUP BY mem_id  ORDER BY SUM(hlb) DESC  ";
        } else {
            $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  pmem_id !=0 and date_format(create_time,'%Y-%m') between date_format(DATE_SUB(curdate(), INTERVAL 0 MONTH),'%Y-%m')  and date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m') GROUP BY mem_id  ORDER BY SUM(hlb) DESC ";
        }
        $data = array();
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $hlb_info = $hlb_model->findBySql($sql . " limit " . $index . ",1");
            $memname = $mem_model->findByPk($hlb_info["mem_id"])->mem_name;
            $data[$index][0] = $num;
            $data[$index][1] = mb_substr($memname, 0, 4, 'utf-8') . '**';
            $data[$index][2] = number_format(intval($hlb_info["hlbnum"]));
            $data[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }
        $this->renderPartial('show', array('hlb_info' => $hlb_info, "data" => json_encode($data), "count" => intval($count)));
    }

    //好友注册
    function actionReg() {
        if (!empty($_POST["memid"])) {
            $memid = $_POST["memid"];
            $regmem = Mem::model()->findBySql("select * from {{mem}} where id=" . $memid);
            $memfri_model = new Memfri();
            if (isset($_POST['Memfri'])) {
                foreach ($_POST['Memfri'] as $_k => $_v) {
                    $memfri_model->$_k = strip_tags($_v);
                }
                $memfri_model->pwd = $_POST['Memfri']["pwd"] . "wp"; //老平台密码加入wp
                $memfri_model->pwd2 = $_POST['Memfri']["pwd2"] . "wp"; //老平台密码加入wp
                $memfri_model->memimg_id = rand(1, 18); //随机分配头像
                $memfri_model->ip = $_SERVER['REMOTE_ADDR']; //存入注册的ip
                if ($memfri_model->save()) {
                    //上级好友id
                    if (!empty($regmem["pid"])) {
                        $pid = $regmem["pid"] . $regmem['id'] . ",";
                    } else {
                        $pid = $regmem["id"] . ",";
                    }
                    $memfri_model->pid = $pid;
                    $memfri_model->update();
                    $memfri_model->login();
                    $system_info = System::model()->findByPk(1);
                    $hlb = $system_info["zc_rewards"]; //注册奖励
                    $memfriid = $memfri_model["id"];
                    //注册奖励元宝
                    $title = "成功注册、";
                    $content = $title . "，获得" . $hlb . "元宝红包奖励";
                    $this->updhlb($hlb, 22, $content, $memfriid, 0); //元宝
                    if (!empty($hlb)) {
                        $this->sendmessage($title, $content, 1, $memfriid);
                    }
                    Yii::app()->user->setFlash('zcstart', 'success');
                    $this->redirect(SITE_URL);
                }
            }
            $this->renderPartial('reg', array('memfri_model' => $memfri_model, "memid" => $memid), '', $processOutput = TRUE);
        } else {
            $this->redirect(SITE_URL . "site/error");
        }
    }

    //邀请地址链接跳转
    function actionReturn() {
        $memid = $_GET["id"];
        $regmem_info = Mem::model()->findBySql("select * from {{mem}} where id=" . $memid);
        if (!empty($regmem_info)) {
            $this->renderPartial('tz', array('memid' => $memid));
        } else {
            $this->redirect(SITE_URL . "site/error");
        }
    }

}
