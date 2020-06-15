<?php

/*
 * 游戏类型
 */

class GameController extends Controller {
    /*
     * 展示
     */

    function actionShow() {
        $id = 0;
        $sb = '';
        $sql = "SELECT * FROM {{game}} where is_display = 1   and TO_DAYS(end_time) >= (TO_DAYS(NOW())-3)  ";
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            $sb = $sb . " and game_type_id =" . $id;
        }
        $sql = $sql . $sb . " order by  begin_time desc";
        $game_info = Game::model()->findAllBySql($sql);
        //今日排名
        $sql1 = "select mem_id,SUM(hlb) as hlb from {{game_gradedata}} WHERE  TO_DAYS(lq_time) = TO_DAYS(NOW()) and game_id != 478 group by mem_id order by SUM(hlb) desc , lq_time asc";
        //昨日排名
        $sql2 = "select mem_id ,SUM(hlb) as hlb from {{game_gradedata}} WHERE  TO_DAYS(lq_time) = (TO_DAYS(NOW())-1) and game_id != 478 group by mem_id order by SUM(hlb) desc , lq_time asc ";
        $data1 = array();
        $data2 = array();
        $gamegradedata_model = Gamegradedata::model();
        $mem_model = Mem::model();
        $rank_model = Rank::model();
        $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=1  and start='已开启' order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=1 and start='已开启'  order by grade ");
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $gamegradedata1 = $gamegradedata_model->findBySql($sql1 . " limit " . $index . ",1");
            $memname1 = $mem_model->findByPk($gamegradedata1["mem_id"])->mem_name;
            $data1[$index][0] = $num;
            $data1[$index][1] = mb_substr($memname1, 0, 4, 'utf-8') . '**';
            $data1[$index][2] = number_format(intval($gamegradedata1["hlb"]));
            $data1[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
            //昨日数据
            $gamegradedata2 = $gamegradedata_model->findBySql($sql2 . " limit " . $index . ",1");
            $memname2 = $mem_model->findByPk($gamegradedata2["mem_id"])->mem_name;
            $data2[$index][0] = $num;
            $data2[$index][1] = mb_substr($memname2, 0, 4, 'utf-8') . '**';
            $data2[$index][2] = number_format(intval($gamegradedata2["hlb"]));
            $data2[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }
        $this->renderPartial('show', array("data1" => json_encode($data1), "data2" => json_encode($data2), "count" => intval($count), 'game_info' => $game_info, "id" => $id));
    }
    /*
     * 详细
     */
    function actionDetail($id) {
        $game_model = Game::model();
        $game_info = $game_model->findByPk($id);
        if (!empty($game_info)) {
            //游戏未开始
            $begin = $game_model->countBySql("select count(*) from {{game}} where  id=" . $id . " and begin_time < now()");
            if (empty($begin)) {
                Yii::app()->user->setFlash('msg', "对不起，该游戏将在" . $game_info["begin_time"] . "上线，敬请期待！");
                $this->renderPartial('msg');
                return;
            }
            //游戏已结束
            $end = $game_model->countBySql("select count(*) from {{game}} where  id=" . $id . " and TO_DAYS(end_time) >= (TO_DAYS(NOW())-3)");
            if (empty($end)) {
                Yii::app()->user->setFlash('msg', '对不起，此游戏已下线，请试玩其他游戏！');
                $this->renderPartial('msg');
                return;
            }
            $endtime = strtotime($game_info['end_time']);
            //冲级比赛数据
            $sql = " select * from {{game_impact}} where game_id=" . $id . " order by rank ";
            $criteria = new CDbCriteria();
            $result = Yii::app()->db->createCommand($sql)->query();
            $pages = new CPagination($result->rowCount);
            $pages->pageSize = 10;
            if (!empty($id)) {
                $pages->params = array('id' => $id);
            }
            $pages->applyLimit($criteria);
            $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
            $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $posts = $result->query();
            //试玩排名
            $gamedata_model = Gamedata::model();
            $sql3 = "select level,role  from {{game_data}} where game_id=" . $id . "  ORDER BY level DESC limit 50 ";
            $gamedata_info = $gamedata_model->findAllBySql($sql3);
            $count = $gamedata_model->countBySql("select count(*)  from {{game_data}} where game_id=" . $id . "  ORDER BY level DESC limit 50");
            $rankdata = array();
            foreach ($gamedata_info as $index => $gamedatainfo) {
                $num = $index + 1;
                $rankdata[$index][0] = $num;
                $rankdata[$index][1] = $gamedatainfo["role"];
                $rankdata[$index][2] = $gamedatainfo["level"];
            }
            if ($game_info["bustype"] == 1) {
                $this->renderPartial('55e5', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
            } else if ($game_info["bustype"] == 2) {
                $this->renderPartial('ppwan', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
            }else if ($game_info["bustype"]==12) {
                $this->renderPartial('345sw', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
			}else if ($game_info["bustype"]==13) {
                $this->renderPartial('xdl', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
            } else if ($game_info["bustype"] >= 5) {
                $this->renderPartial('detail2', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
            } else {
                $this->renderPartial('detail', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages));
            }
        }
    }

    /*
     * 领取奖励
     */

    function actionRewards() {
        if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
            $memid = Yii::app()->request->getParam('memid');
            $gameid = Yii::app()->request->getParam('gameid');
            $level = Yii::app()->request->getParam('level');
            $gamedata = Gamegradedata::model()->findBySql("select * from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $level);
            if (empty($gamedata["valid"]) && !empty($gamedata)) {
                $game_info = Game::model()->findByPk($gameid);
                //等级升级奖励发放
                $title1 = "玩" . $game_info["name"] . "游戏升" . $gamedata->level . "级!";
                $content1 = "试玩平台：" . $title1 . ",奖励元宝：" . $gamedata["hlb"];
                $this->updhlb($gamedata["hlb"], 3, $content1, $memid, 0);
                $this->sendmessage($title1, $content1, 1, $memid);
                $gamedata->lq_time = date("Y-m-d H:i:s", time());
                $gamedata->valid = 1; //表示已经领取奖励
                $gamedata->update();
                //冲级奖励发放
                $gamedata_info = Gamedata::model()->findBySql("select * from {{game_data}} where mem_id=" . $memid . " and game_id=" . $gameid);
                $gameimpact = Gameimpact::model()->findBySql("select *  from {{game_impact}} where game_id=" . $gamedata->game_id . " and level =" . $gamedata->level . " and mem_id is  null order by rank limit 1 ");
                if (!empty($gameimpact)) {
                    $title2 = "玩" . $game_info["name"] . "冲" . $gamedata->level . "级!";
                    $content2 = "试玩平台:" . $title2 . "奖励元宝" . $gameimpact["hlb"];
                    $hlb_model2 = $this->updhlb($gameimpact["hlb"], 3, $content2, $memid, 0);
                    $this->sendmessage($title2, $content2, 1, $memid);
                    //存入元宝id
                    $gameimpact->lq_time = date("Y-m-d H:i:s", time());
                    $gameimpact->role = $gamedata_info["role"];
                    $gameimpact->hlb_id = $hlb_model2["id"];
                    $gameimpact->mem_id = $memid;
                    $gameimpact->valid = 1;
                    $gameimpact->update();
                }
                //查询这款游戏有没有任务
                $task_model = Task::model();
                $task_info = $task_model->findAllBySql("select * from {{task}} where valid !=1 and game_id= " . $gameid);
                $flag = FALSE; //默认没有任务
                if (!empty($task_info) && $memid >= 49727) {
                    $flag = TRUE;
                }
                //任务类型触发
                if ($flag) {
                    foreach ($task_info as $taskinfo) {
                        if ($level == $taskinfo["grade"]) {
                            $count = Taskdata::model()->countBySql("select count(*) from {{task_data}} where mem_id=" . $memid . " and grade=" . $level . " and game_id=" . $gameid);
                            if (empty($count)) {
                                $taskdata_model = new Taskdata();
                                $taskdata_model->grade = $level;
                                $taskdata_model->game_id = $gameid;
                                $taskdata_model->mem_id = $memid;
                                $taskdata_model->type = $taskinfo["task_type"];
                                $taskdata_model->save();
                            }
                        }
                    }
                }
                $hlbnum = $gamedata["hlb"];
                //上级会员奖励
                $mem_info = Mem::model()->findByPk($memid);
                if (!empty($mem_info["pid"])) {
                    $array = explode(",", $mem_info["pid"]);
                    $n = count($array);
                    $j = 1;
                    for ($i = ($n - 2); $i >= 0; $i--) {
                        if ($j == 1 || $j == 2 || $j == 3 || $j == 4) {
                            $system_info = System::model()->findByPk(1);
                            if ($j == 1) {
                                if (!empty($mem_info["role"])) {
                                    $rewadsmemhlb = $system_info['zzgame1'];
                                    $title3 = $game_info["name"] . " 站长1级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                } else {
                                    $rewadsmemhlb = $system_info['game1'];
                                    $title3 = $game_info["name"] . " 1级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                }
                            } else if ($j == 2) {
                                if (!empty($mem_info["role"])) {
                                    $rewadsmemhlb = $system_info['zzgame2'];
                                    $title3 = $game_info["name"] . " 站长2级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                } else {
                                    $rewadsmemhlb = $system_info['game2'];
                                    $title3 = $game_info["name"] . " 2级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                }
                            } else if ($j == 3) {
                                if (!empty($mem_info["role"])) {
                                    $rewadsmemhlb = $system_info['zzgame3'];
                                    $title3 = $game_info["name"] . " 站长3级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                } else {
                                    $rewadsmemhlb = $system_info['game3'];
                                    $title3 = $game_info["name"] . " 3级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                }
                            } else if ($j == 4) {
                                if (!empty($mem_info["role"])) {
                                    $rewadsmemhlb = $system_info['zzgame4'];
                                    $title3 = $game_info["name"] . " 站长4级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                } else {
                                    $rewadsmemhlb = $system_info['game4'];
                                    $title3 = $game_info["name"] . " 4级好友(" . $mem_info["mem_name"] . ")领取试玩奖励";
                                }
                            }
                            $hlbsum = $hlbnum * ($rewadsmemhlb / 100);
                            $content3 = $title3 . "奖" . $hlbsum . "元宝";
                            $this->updhlb($hlbsum, 3, $content3, $array[$i], $memid);
                            if (!empty($hlbsum)) {
                                $this->sendmessage($title3, $content3, 1, $array[$i]);
                            }
                        }
                        $j++;
                    }
                }
                echo "领取" . $gamedata->level . "等级奖励成功！";
            } else {
                echo "您已经领取奖励了！";
            }
        }
    }

    function actionWowreturn(){
        $wowre['memberid'] = $_GET["memberid"];
        $wowre['point'] = $_GET["point"];
        $wowre['offer_name'] = urldecode($_GET["programname"]);
        $wowre['eventid'] = $_GET["eventid"];
        $wowre['websiteid'] = $_GET["websiteid"];
        $wowre['immediate'] = $_GET["immediate"];
        $wowre['sign'] = $_GET["sign"];
        $wowre['key'] = "tyh877488";
        if($wowre['memberid']=='' || $wowre['eventid'] =='' || $wowre['point']=='' ||$wowre['websiteid'] ==''){
            $wowre['immediate']=0;
            $wowre['status'] ='failure';
            $wowre['errno'] ='offerwow-01';
            die(json_encode($wowre));
        }
        $mypass = strtoupper(md5($wowre['memberid'].$wowre['point'].$wowre['eventid'].$wowre['websiteid'].$wowre['immediate'].$wowre['key']));
        if($mypass==$wowre['sign']){
            if($wowre['immediate']==1){
                $content1 =  "体验".$wowre['offer_name']."奖" . $point . "元宝";
                $this->updhlb($point, 3, $content1, $wowre['memberid'], 0);
            }else if($wowre['immediate']==2){
                $content1 =  "体验".$wowre['offer_name']."奖" . $point . "元宝";
                $this->updhlb($point, 3, $content1, $wowre['memberid'], 0);
            }
        }

    }

    //试玩游戏注册返回数据
    function actionZcinfo() {
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['uid']) && empty($_GET['gid']) && empty($_GET['guid']) && empty($_GET['username']) && empty($_GET['cid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //游戏不存在
            $game_num = $game_model->countBySql("select count(*) from {{game}} where   id=" . $_GET['gid']);
            if (empty($game_num)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['gid'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['uid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }
            //此账号已经绑定过
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  mem_id=" . $_GET['uid'] . " and guid=" . $_GET['guid'] . " and cid=" . $_GET['cid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            }
            //注册
            $gamezm_model = new Gamezm();
            $gamezm_model->mem_id = $_GET['uid'];
            $gamezm_model->gid = $_GET['gid']; //、游戏id
            $gamezm_model->cid = $_GET['cid']; //厂商id
            $gamezm_model->guid = $_GET['guid'];
            $gamezm_model->username = $_GET['username'];
            //传递成功
            if ($gamezm_model->save()) {
                $returnmsg_model->reason = 0;
                $returnmsg_model->save();
                echo json_encode(array("start" => 0));
                return;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    function actionZc345(){
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['regid']) && empty($_GET['offerId']) && empty($_GET['id']) && empty($_GET['uname']) && empty($_GET['qid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //游戏不存在
            $game_info = $game_model->findBySql("select * from {{game}} where   id=" . $_GET['qid']);
            if (empty($game_info)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['qid'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['regid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }

            //此账号已经绑定过
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  gid=" . $game_info["id"] . " and  guid=" . $_GET['regid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            } else {
                //注册
                $gamezm_model = new Gamezm();
                $gamezm_model->mem_id = $_GET['regid'];
                $gamezm_model->gid = $game_info["id"]; //、游戏id
                $gamezm_model->cid = $game_info['cid']; //厂商id
                $gamezm_model->guid = $_GET['id'];
                $gamezm_model->username = $_GET['uname'];
                //传递成功
                if ($gamezm_model->save()) {
                    $returnmsg_model->reason = 0;
                    $returnmsg_model->save();
                    echo json_encode(array("start" => 0));
                    return;
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
	
	   //挖米拉试玩游戏注册返回数据
    function actionWamilareturn(){
		try {
			$wamila['userid'] = $_GET["userid"];
			$wamila['gold'] = $_GET["gold"];
			$wamila['tname'] = urldecode($_GET["tname"]);
			$wamila['tid'] = $_GET["tid"];
			$wamila['time'] = $_GET['time'];
			$wamila['sign'] = $_GET["sign"];
			$wamila['key'] = "shubaoe_com";
			$returnmsg_model = new Returnmsg();
			$returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
			if (empty($wamila['userid']) && empty($wamila['tid']) && empty($wamila['gold'])) {
					$returnmsg_model->reason = 1;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					$wamilas['time']=$wamila['time'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1001';
					die(json_encode($wamilas));
					return;
			}
			$mypass = strtoupper(md5($wamila['key'].$wamila['userid'].$wamila['tid'].$wamila['gold']));
			//var_dump($wamila['sign']);
			//var_dump($mypass);
			if($mypass == $wamila['sign']){
				
				//此会员不存在
				$mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $wamila['userid']);
				if (empty($mem_num)) {
					$returnmsg_model->reason = 4;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					$wamilas['time']=$wamila['time'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1005';
					die(json_encode($wamilas));
					return;
				}
				//tid重复
				$tidzm_num = Gamewamilazm::model()->countBySql("select count(*) from {{game_wamila_zm}} where tid ='" . $wamila['tid'] . "'");
				if (!empty($tidzm_num)) {
					$returnmsg_model->reason = 5;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					$wamilas['time']=$wamila['time'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1003';
					die(json_encode($wamilas));
					return;
				}else{
				
				//注册
				$gamewamilazm_model = new Gamewamilazm();
				$gamewamilazm_model->mem_id = $wamila['userid'];
				$gamewamilazm_model->tid = $wamila['tid']; //
				$gamewamilazm_model->tname = $wamila['tname']; //厂商id
				$gamewamilazm_model->gold = $wamila['gold'];
				$gamewamilazm_model->sign = $wamila['sign'];
				$gamewamilazm_model->ctime = $wamila['time'];
				//var_dump('xxx');
				//传递成功
				if ($gamewamilazm_model->save()) {
					$returnmsg_model->reason = 0;
					$returnmsg_model->save();
					
					$content1 =  "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					$title1 = "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					
					$this->updhlb($wamila['gold'], 3, $content1, $wamila['userid'], 0);
					$this->sendmessage($title1, $content1, 1, $wamila['userid']);
					
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					$wamilas['time']=$wamila['time'];
					$wamilas['status'] ='success';
					$wamilas['errno'] ='0';
					die(json_encode($wamilas));
					return;
				}else{
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					$wamilas['time']=$wamila['time'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1004';
					die(json_encode($wamilas));
					return;
				}
				}
			}else{
				$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
				$wamilas['time']=$wamila['time'];
				$wamilas['status'] ='failure';
				$wamilas['errno'] ='1002';
				die(json_encode($wamilas));
				return;
			}
		} catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }


  //任务吧注册返回数据
    function actionOffreturn(){
		try {
			$wamila['userid'] = $_GET["uid"];
			$wamila['gold'] = $_GET["point"];
			$wamila['tname'] = urldecode($_GET["task_name"]);
			$wamila['tid'] = $_GET["task_id"];
			$wamila['time'] = strtotime("now");
			$wamila['sign'] = $_GET["sign"];
			$wamila['key'] = "3988dd742358d0ea0cc14111f5f96856";
			$returnmsg_model = new Returnmsg();
			$returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
			if (empty($wamila['userid']) && empty($wamila['tid']) && empty($wamila['gold'])) {
					$returnmsg_model->reason = 1;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1001';
					die(json_encode($wamilas));
					return;
			}
			$mypass = md5($wamila['userid'].$wamila['gold'].$wamila['tid'].$wamila['key']);
			
			//var_dump($wamila['sign']);
			//var_dump($mypass);
			if($mypass == $wamila['sign']){
				
				//此会员不存在
				$mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $wamila['userid']);
				if (empty($mem_num)) {
					$returnmsg_model->reason = 4;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1005';
					die(json_encode($wamilas));
					return;
				}
				//sign重复
				$tidzm_num = Gamewamilazm::model()->countBySql("select count(*) from {{game_wamila_zm}} where sign ='" . $wamila['sign'] . "'");
				if (!empty($tidzm_num)) {
					$returnmsg_model->reason = 5;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1003';
					die(json_encode($wamilas));
					return;
				}else{
				
				//注册
				$gamewamilazm_model = new Gamewamilazm();
				$gamewamilazm_model->mem_id = $wamila['userid'];
				$gamewamilazm_model->tid = $wamila['tid']; //
				$gamewamilazm_model->tname = $wamila['tname']; //厂商id
				$gamewamilazm_model->gold = $wamila['gold'];
				$gamewamilazm_model->sign = $wamila['sign'];
				$gamewamilazm_model->ctime = $wamila['time'];
				//var_dump('xxx');
				//传递成功
				if ($gamewamilazm_model->save()) {
					$returnmsg_model->reason = 0;
					$returnmsg_model->save();
					
					$content1 =  "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					$title1 = "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					
					$this->updhlb($wamila['gold'], 3, $content1, $wamila['userid'], 0);
					$this->sendmessage($title1, $content1, 1, $wamila['userid']);
					
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='success';
					$wamilas['errno'] ='0';
					die(json_encode($wamilas));
					return;
				}else{
					$wamilas['userid']=$wamila['userid'];
					$wamilas['tid']=$wamila['tid'];
					$wamilas['tname']=$wamila['tname'];
					$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1004';
					die(json_encode($wamilas));
					return;
				}
				}
			}else{
				$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
				
				$wamilas['status'] ='failure';
				$wamilas['errno'] ='1002';
				die(json_encode($wamilas));
				return;
			}
		} catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }




   //新游盟试玩游戏注册返回数据
    function actionXinyoumengreturn(){
		try {
			$wamila['userid'] = $_GET["uid"];
			$wamila['gold'] = $_GET["coin"];
			$wamila['tname'] = iconv("GBK", "UTF-8//IGNORE", $_GET["gamename"]);
			$wamila['tid'] = $_GET["order_id"];
		    $wamila['sign'] = $_GET["sign"];
			$wamila['time'] = strtotime("now");
			$wamila['key'] = "290703411";
			$returnmsg_model = new Returnmsg();
			$returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
			if (empty($wamila['userid']) && empty($wamila['tid']) && empty($wamila['gold'])) {
					$returnmsg_model->reason = 1;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1001';
					die(json_encode($wamilas));
					return;
			}
			$mypass = md5($wamila['userid'].$wamila['gold'].$wamila['tid'].$wamila['key']);
			//var_dump($wamila['sign']);
			//var_dump($mypass);
			if($mypass == $wamila['sign']){
				
				//此会员不存在
				$mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $wamila['userid']);
				if (empty($mem_num)) {
					$returnmsg_model->reason = 4;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1005';
					die(json_encode($wamilas));
					return;
				}
				//tid重复
				$tidzm_num = Gamewamilazm::model()->countBySql("select count(*) from {{game_wamila_zm}} where tid ='" . $wamila['tid'] . "'");
				if (!empty($tidzm_num)) {
					$returnmsg_model->reason = 5;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1003';
					die(json_encode($wamilas));
					return;
				}else{
				
				//注册
				$gamewamilazm_model = new Gamewamilazm();
				$gamewamilazm_model->mem_id = $wamila['userid'];
				$gamewamilazm_model->tid = $wamila['tid']; //
				$gamewamilazm_model->tname = $wamila['tname']; //厂商id
				$gamewamilazm_model->gold = $wamila['gold'];
				$gamewamilazm_model->sign = $wamila['sign'];
				$gamewamilazm_model->ctime = $wamila['time'];
				//var_dump('xxx');
				//传递成功
				if ($gamewamilazm_model->save()) {
					$returnmsg_model->reason = 0;
					$returnmsg_model->save();
					
					$content1 =  "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					$title1 = "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					
					$this->updhlb($wamila['gold'], 3, $content1, $wamila['userid'], 0);
					$this->sendmessage($title1, $content1, 1, $wamila['userid']);
					
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
				
					$wamilas['status'] ='success';
					$wamilas['errno'] ='0';
					die(json_encode($wamilas));
					return;
				}else{
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1004';
					die(json_encode($wamilas));
					return;
				}
				}
			}else{
				$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
			
				$wamilas['status'] ='failure';
				$wamilas['errno'] ='1002';
				die(json_encode($wamilas));
				return;
			}
		} catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }


   
   
   //惠享游试玩游戏注册返回数据
    function actionHuixiangyoureturn(){
		try {
			$wamila['userid'] = $_GET["uid"];
			$wamila['gold'] = $_GET["points"];
			$wamila['tname'] = $_GET["name"];
			$wamila['tid'] = $_GET["tid"];
		    $wamila['sign'] = $_GET["sign"];
			$wamila['time'] = strtotime("now");
			$wamila['key'] = "shubaoe_com";
			$returnmsg_model = new Returnmsg();
			$returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
			if (empty($wamila['userid']) && empty($wamila['tid']) && empty($wamila['gold'])) {
					$returnmsg_model->reason = 1;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1001';
					die(json_encode($wamilas));
					return;
			}
			$mypass = md5($wamila['userid'].$wamila['gold'].$wamila['tid'].$wamila['key']);
			//var_dump($wamila['sign']);
			//var_dump($mypass);
			if($mypass == $wamila['sign']){
				
				//此会员不存在
				$mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $wamila['userid']);
				if (empty($mem_num)) {
					$returnmsg_model->reason = 4;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1005';
					die(json_encode($wamilas));
					return;
				}
				//tid重复
				$tidzm_num = Gamewamilazm::model()->countBySql("select count(*) from {{game_wamila_zm}} where tid ='" . $wamila['tid'] . "'");
				if (!empty($tidzm_num)) {
					$returnmsg_model->reason = 5;
					$returnmsg_model->save();
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1003';
					die(json_encode($wamilas));
					return;
				}else{
				
				//注册
				$gamewamilazm_model = new Gamewamilazm();
				$gamewamilazm_model->mem_id = $wamila['userid'];
				$gamewamilazm_model->tid = $wamila['tid']; //
				$gamewamilazm_model->tname = $wamila['tname']; //厂商id
				$gamewamilazm_model->gold = $wamila['gold'];
				$gamewamilazm_model->sign = $wamila['sign'];
				$gamewamilazm_model->ctime = $wamila['time'];
				//var_dump('xxx');
				//传递成功
				if ($gamewamilazm_model->save()) {
					$returnmsg_model->reason = 0;
					$returnmsg_model->save();
					
					$content1 =  "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					$title1 = "体验".$wamila['tname']."奖" . $wamila['gold'] . "元宝";
					
					$this->updhlb($wamila['gold'], 3, $content1, $wamila['userid'], 0);
					$this->sendmessage($title1, $content1, 1, $wamila['userid']);
					
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
				
					$wamilas['status'] ='success';
					$wamilas['errno'] ='0';
					die(json_encode($wamilas));
					return;
				}else{
					$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
					
					$wamilas['status'] ='failure';
					$wamilas['errno'] ='1004';
					die(json_encode($wamilas));
					return;
				}
				}
			}else{
				$wamilas['userid']=$wamila['userid'];
				$wamilas['tid']=$wamila['tid'];
				$wamilas['tname']=$wamila['tname'];
				$wamilas['gold']=$wamila['gold'];
			
				$wamilas['status'] ='failure';
				$wamilas['errno'] ='1002';
				die(json_encode($wamilas));
				return;
			}
		} catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }






	//新动力试玩游戏注册返回数据
    function actionZcxdl() {
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['uid']) && empty($_GET['gid']) && empty($_GET['guid']) && empty($_GET['username']) && empty($_GET['gameid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //游戏不存在
            $game_info = $game_model->findBySql("select * from {{game}} where   id=" . $_GET['gameid']);
            if (empty($game_info)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['gameid'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['uid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }

            //此账号已经绑定过
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  gid=" . $game_info["id"] . " and  guid=" . $_GET['guid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            } else {
                //注册
                $gamezm_model = new Gamezm();
                $gamezm_model->mem_id = $_GET['uid'];
                $gamezm_model->gid = $game_info["id"]; //、游戏id
                $gamezm_model->cid = $game_info['aid']; //厂商id
                $gamezm_model->guid = $_GET['guid'];
                $gamezm_model->username = $_GET['username'];
                //传递成功
                if ($gamezm_model->save()) {
                    $returnmsg_model->reason = 0;
                    $returnmsg_model->save();
                    echo json_encode(array("start" => 0));
                    return;
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }


    //55e5试玩游戏注册返回数据
    function actionZc55e5() {
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['uid']) && empty($_GET['gid']) && empty($_GET['guid']) && empty($_GET['username']) && empty($_GET['gameid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //游戏不存在
            $game_info = $game_model->findBySql("select * from {{game}} where   id=" . $_GET['gameid']);
            if (empty($game_info)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['gameid'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['uid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }

            //此账号已经绑定过
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  gid=" . $game_info["id"] . " and  guid=" . $_GET['guid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            } else {
                //注册
                $gamezm_model = new Gamezm();
                $gamezm_model->mem_id = $_GET['uid'];
                $gamezm_model->gid = $game_info["id"]; //、游戏id
                $gamezm_model->cid = $game_info['cid']; //厂商id
                $gamezm_model->guid = $_GET['guid'];
                $gamezm_model->username = $_GET['username'];
                //传递成功
                if ($gamezm_model->save()) {
                    $returnmsg_model->reason = 0;
                    $returnmsg_model->save();
                    echo json_encode(array("start" => 0));
                    return;
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //试玩游戏新注册接口
    function actionPpwanreginfo() {
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['sid']) || empty($_GET['uid']) || empty($_GET['username']) || empty($_GET['adcode'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //此游戏不存在
            $count = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['adcode']);
            $game_info = $game_model->findBySql("select * from {{game}} where  id=" . $_GET['adcode']);
            if (empty($count)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where  id=" . $_GET['adcode'] . " and zc_end_time >= now()");
            if (empty($zcstatus)) {
                $returnmsg_model->reason = 3;
                $returnmsg_model->save();
                echo json_encode(array("start" => 3));
                return;
            }
            //此会员不存在
            $mem_num = Mem::model()->countBySql("select count(*) from {{mem}} where  id=" . $_GET['sid']);
            if (empty($mem_num)) {
                $returnmsg_model->reason = 4;
                $returnmsg_model->save();
                echo json_encode(array("start" => 4));
                return;
            }

            //此账号已经绑定过
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  gid=" . $_GET['adcode'] . " and guid=" . $_GET['uid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            }
            //注册
            $gamezm_model = new Gamezm();
            $gamezm_model->mem_id = $_GET['sid'];
            $gamezm_model->gid = $_GET['adcode']; //、游戏id
            $gamezm_model->cid = $game_info["cid"]; //厂商id
            $gamezm_model->guid = $_GET['uid'];
            $gamezm_model->username = $_GET['username'];
            //传递成功
            if ($gamezm_model->save()) {
                $returnmsg_model->reason = 0;
                $returnmsg_model->save();
                echo json_encode(array("start" => 0));
                return;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //试玩游戏新注册接口
    function actionReginfo() {
        try {
            $game_model = Game::model();
            $returnmsg_model = new Returnmsg();
            $returnmsg_model->name = $_SERVER['SERVER_NAME'] . $_SERVER["REQUEST_URI"];
            //参数缺省
            if (empty($_GET['hlz_uid']) || empty($_GET['hlz_gid']) || empty($_GET['game_uid']) || empty($_GET['username']) || empty($_GET['hlz_cid'])) {
                $returnmsg_model->reason = 1;
                $returnmsg_model->save();
                echo json_encode(array("start" => 1));
                return;
            }
            //此游戏不存在
            $count = $game_model->countBySql("select count(*) from {{game}} where cid=" . $_GET['hlz_cid'] . " and id=" . $_GET['hlz_gid']);
            if (empty($count)) {
                $returnmsg_model->reason = 2;
                $returnmsg_model->save();
                echo json_encode(array("start" => 2));
                return;
            }
            //注册时间到了
            $zcstatus = $game_model->countBySql("select count(*) from {{game}} where cid=" . $_GET['hlz_cid'] . " and id=" . $_GET['hlz_gid'] . " and zc_end_time >= now()");
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
            $gamezm_num = Gamezm::model()->countBySql("select count(*) from {{game_zm}} where  gid=" . $_GET['hlz_gid'] . " and guid=" . $_GET['game_uid']);
            if (!empty($gamezm_num)) {
                $returnmsg_model->reason = 5;
                $returnmsg_model->save();
                echo json_encode(array("start" => 5));
                return;
            }
            //注册
            $gamezm_model = new Gamezm();
            $gamezm_model->mem_id = $_GET['hlz_uid'];
            $gamezm_model->gid = $_GET['hlz_gid']; //、游戏id
            $gamezm_model->cid = $_GET['hlz_cid']; //厂商id
            $gamezm_model->guid = $_GET['game_uid'];
            $gamezm_model->username = $_GET['username'];
            //传递成功
            if ($gamezm_model->save()) {
                $returnmsg_model->reason = 0;
                $returnmsg_model->save();
                echo json_encode(array("start" => 0));
                return;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
	
	
	
	//获取新动力游戏等级数据
    function actionGradexdl() {
        try {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $memid = Yii::app()->request->getParam('memid'); //、游戏id
                $gid = Yii::app()->request->getParam('gid'); //、游戏id
                $game_info = Game::model()->findBySql("select * from {{game}} where id= " . $gid);
                $url = $game_info["return_url"] . "?&uid=" . $memid . "&sign=" . md5("471" . $game_info["game_id"] . $memid . "8bjvzaor83ue9m1czqdb9zu6c7kw85qu");
               $resu = file_get_contents($url);
                $result = json_decode($resu);
                $data = $result->user_info;
                $level = $data->level;
                if (empty($result->error_code)) {//表示查询等级没有错误
                    $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=" . $gid . " and mem_id=" . $memid);
                    $memid = $gamezm_info["mem_id"];
                    $gameid = $gamezm_info["gid"];
                    $grade_model = Gamegrade::model();
                    $gamedata_model = Gamedata::model();
                    $gamegradata_model = Gamegradedata::model();
                    $gamedata = $gamedata_model->findBySql("select * from {{game_data}} where  mem_id=" . $memid . " and game_id=" . $gameid);
                    if (empty($gamedata)) {
                        $gamedata_model = new Gamedata();
                        $gamedata_model->mem_id = $memid;
                        $gamedata_model->game_id = $gameid;
                        $gamedata_model->guid = $gamezm_info["guid"];
                        $gamedata_model->username = $data->username;
                        $gamedata_model->servername = urldecode($data->servername);
                        $gamedata_model->role = urldecode($data->role);
                        $gamedata_model->level = $level;
                        $gamedata_model->update_time = date("Y-m-d H:i:s", time());
                        $gamedata_model->save();
                    } else {
                        $gamedata->username = $data->username;
                        $gamedata->role = urldecode($data->role);
                        $gamedata->level = $level;
                        $gamedata->update_time = date("Y-m-d H:i:s", time());
                        $gamedata->update();
                    }
                    $gamegrade = $grade_model->findAllBySql("select * from {{game_grade}} where game_id= " . $gameid . " and level <=" . $level);
                    if (!empty($gamegrade)) {
                        foreach ($gamegrade as $grade) {
                            $count = $gamegradata_model->countBySql("select count(*) from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $grade["level"]);
                            if (empty($count)) {
                                $gamegradedata_model = new Gamegradedata();
                                $gamegradedata_model->valid = 0; //表示未领取
                                $gamegradedata_model->level = $grade["level"];
                                $gamegradedata_model->mem_id = $memid;
                                $gamegradedata_model->hlb = $grade["hlb"];
                                $gamegradedata_model->game_id = $gameid;
                                $gamegradedata_model->save();
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //获取玩游戏等级数据
    function actionGrade55e5() {
        try {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $memid = Yii::app()->request->getParam('memid'); //、游戏id
                $gid = Yii::app()->request->getParam('gid'); //、游戏id
                $game_info = Game::model()->findBySql("select * from {{game}} where id= " . $gid);
                $url = $game_info["return_url"] . "?&uid=" . $memid . "&sign=" . md5("192" . $game_info["game_id"] . $memid . "81cfd22c6c3f38e3761931feb632ef25");
               $resu = file_get_contents($url);
                $result = json_decode($resu);
                $data = $result->user_info;
                $level = $data->level;
                if (empty($result->error_code)) {//表示查询等级没有错误
                    $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=" . $gid . " and mem_id=" . $memid);
                    $memid = $gamezm_info["mem_id"];
                    $gameid = $gamezm_info["gid"];
                    $grade_model = Gamegrade::model();
                    $gamedata_model = Gamedata::model();
                    $gamegradata_model = Gamegradedata::model();
                    $gamedata = $gamedata_model->findBySql("select * from {{game_data}} where  mem_id=" . $memid . " and game_id=" . $gameid);
                    if (empty($gamedata)) {
                        $gamedata_model = new Gamedata();
                        $gamedata_model->mem_id = $memid;
                        $gamedata_model->game_id = $gameid;
                        $gamedata_model->guid = $gamezm_info["guid"];
                        $gamedata_model->username = $data->username;
                        $gamedata_model->servername = urldecode($data->servername);
                        $gamedata_model->role = urldecode($data->role);
                        $gamedata_model->level = $level;
                        $gamedata_model->update_time = date("Y-m-d H:i:s", time());
                        $gamedata_model->save();
                    } else {
                        $gamedata->username = $data->username;
                        $gamedata->role = urldecode($data->role);
                        $gamedata->level = $level;
                        $gamedata->update_time = date("Y-m-d H:i:s", time());
                        $gamedata->update();
                    }
                    $gamegrade = $grade_model->findAllBySql("select * from {{game_grade}} where game_id= " . $gameid . " and level <=" . $level);
                    if (!empty($gamegrade)) {
                        foreach ($gamegrade as $grade) {
                            $count = $gamegradata_model->countBySql("select count(*) from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $grade["level"]);
                            if (empty($count)) {
                                $gamegradedata_model = new Gamegradedata();
                                $gamegradedata_model->valid = 0; //表示未领取
                                $gamegradedata_model->level = $grade["level"];
                                $gamegradedata_model->mem_id = $memid;
                                $gamegradedata_model->hlb = $grade["hlb"];
                                $gamegradedata_model->game_id = $gameid;
                                $gamegradedata_model->save();
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function actionGrade345(){
        try {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $memid = Yii::app()->request->getParam('memid'); //、游戏id
                $gid = Yii::app()->request->getParam('gid'); //、游戏id
                $game_info = Game::model()->findBySql("select * from {{game}} where id= " . $gid);
                $url = $game_info["return_url"].$memid;
                $resu = file_get_contents($url);
                $result = json_decode($resu);
                $data = $result->result;
                $level = $data->level;
                if ($result->success==1) {//表示查询等级没有错误
                    $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=" . $gid . " and mem_id=" . $memid);
                    $memid = $gamezm_info["mem_id"];
                    $gameid = $gamezm_info["gid"];
                    $grade_model = Gamegrade::model();
                    $gamedata_model = Gamedata::model();
                    $gamegradata_model = Gamegradedata::model();
                    $gamedata = $gamedata_model->findBySql("select * from {{game_data}} where  mem_id=" . $memid . " and game_id=" . $gameid);
                    if (empty($gamedata)) {
                        $gamedata_model = new Gamedata();
                        $gamedata_model->mem_id = $memid;
                        $gamedata_model->game_id = $gameid;
                        $gamedata_model->guid = $gamezm_info["guid"];
                        $gamedata_model->username = $data->offerUserName;
                        $gamedata_model->servername = urldecode($data->srvId);
                        $gamedata_model->role = urldecode($data->roleName);
                        $gamedata_model->level = $level;
                        $gamedata_model->update_time = date("Y-m-d H:i:s", time());
                        $gamedata_model->save();
                    } else {
                        $gamedata->username = $data->offerUserName;
                        $gamedata->role = urldecode($data->roleName);
                        $gamedata->level = $level;
                        $gamedata->update_time = date("Y-m-d H:i:s", time());
                        $gamedata->update();
                    }
                    $gamegrade = $grade_model->findAllBySql("select * from {{game_grade}} where game_id= " . $gameid . " and level <=" . $level);
                    if (!empty($gamegrade)) {
                        foreach ($gamegrade as $grade) {
                            $count = $gamegradata_model->countBySql("select count(*) from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $grade["level"]);
                            if (empty($count)) {
                                $gamegradedata_model = new Gamegradedata();
                                $gamegradedata_model->valid = 0; //表示未领取
                                $gamegradedata_model->level = $grade["level"];
                                $gamegradedata_model->mem_id = $memid;
                                $gamegradedata_model->hlb = $grade["hlb"];
                                $gamegradedata_model->game_id = $gameid;
                                $gamegradedata_model->save();
                            }
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //游戏等级查询
    function actionSelgrade() {
        try {
            if (Yii::app()->request->isAjaxRequest) {//是否ajax请求
                $guid = Yii::app()->request->getParam('guid'); //、游戏id
                $gid = Yii::app()->request->getParam('gid'); //、游戏id
                $game_info = Game::model()->findBySql("select * from {{game}} where id= " . $gid);
                $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=" . $gid . " and guid=" . $guid);
                $url = $game_info['return_url'] . $game_info['game_uid'] . "=" . $gamezm_info['guid'];
                //  echo $url;
                $temp = file_get_contents($url);
                if (!empty($game_info["json_layout"])) {
                    $result = json_decode($temp);
                    $data = $result->$game_info["json_layout"];
                } else {
                    $data = json_decode($temp);
                }
                $memid = $gamezm_info["mem_id"];
                $gameid = $gamezm_info["gid"];
                $level = $data->$game_info["json_level"];
                $grade_model = Gamegrade::model();
                $gamedata_model = Gamedata::model();
                $gamegradata_model = Gamegradedata::model();
                $gamedata = $gamedata_model->findBySql("select * from {{game_data}} where  mem_id=" . $memid . " and game_id=" . $gameid);
                if (empty($gamedata)) {
                    $gamedata_model = new Gamedata();
                    $gamedata_model->mem_id = $memid;
                    $gamedata_model->game_id = $gameid;
                    $gamedata_model->guid = $gamezm_info["guid"];
                    $gamedata_model->username = $gamezm_info["username"];
                    $gamedata_model->servername = urldecode($data->$game_info["json_servername"]);
                    $gamedata_model->role = urldecode($data->$game_info["json_role"]);
                    $gamedata_model->level = $level;
                    $gamedata_model->payment = $data->$game_info["json_payment"];
                    $gamedata_model->update_time = date("Y-m-d H:i:s", time());
                    $gamedata_model->save();
                } else {
                    $gamedata->role = urldecode($data->$game_info["json_role"]);
                    $gamedata->level = $level;
                    $gamedata->update_time = date("Y-m-d H:i:s", time());
                    $gamedata->update();
                }
                $gamegrade = $grade_model->findAllBySql("select * from {{game_grade}} where game_id= " . $gameid . " and level <=" . $level);
                if (!empty($gamegrade)) {
                    foreach ($gamegrade as $grade) {
                        $count = $gamegradata_model->countBySql("select count(*) from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $grade["level"]);
                        if (empty($count)) {
                            $gamegradedata_model = new Gamegradedata();
                            $gamegradedata_model->valid = 0; //表示未领取
                            $gamegradedata_model->level = $grade["level"];
                            $gamegradedata_model->mem_id = $memid;
                            $gamegradedata_model->hlb = $grade["hlb"];
                            $gamegradedata_model->game_id = $gameid;
                            $gamegradedata_model->save();
                        }
                    }
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //页面跳转
    function actionJump($type, $id) {
        $memid = $this->show_mem_id();
        $game_model = Game::model();
        $expad_model = Expad::model();
        if ($type == 1) {
            //55e5 
            $game_info = $game_model->findByPk($id);
            $url = str_replace("{uid}", $memid, $game_info['register_url']) . "&attch=gameid%3D" . $game_info['id'];
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));
        } else if ($type == 2) {
            //ppwan
            $game_info = $game_model->findByPk($id);
            $url = str_replace("{uid}", $memid, $game_info['register_url']);
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));
        } else if ($type == 3) {
            //通用
            $game_info = $game_model->findByPk($id);
            if(!empty($game_info["hlz_gid_valid"])){
                 $url = $game_info['register_url'] . $game_info['hlz_uid'] . "=" . $memid ;
            }else{
                 $url = $game_info['register_url'] . $game_info['hlz_uid'] . "=" . $memid . "&hlz_gid=" . $game_info['id'];
            }
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));
        } else if ($type == 4) {
            //31玩、73游 
            $game_info = $game_model->findByPk($id);
            $url = str_replace("{uid}", $memid, $game_info['register_url']);
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));
        } else if ($type == 5) {
            $expad_info = $expad_model->findByPk($id);
            $url = $expad_info['register_url'] . $expad_info["hlz_uid"] . "=" . $memid . "&" . $expad_info["hlz_expid"] . "=" . $expad_info['id'];
            $this->renderPartial('jump', array('url' => $url, "expad_info" => $expad_info, "type" => $type));
		 } else if ($type == 13) {
            $game_info = $game_model->findByPk($id);
            $url = str_replace("{uid}", $memid, $game_info['register_url']) . "&attch=gameid%3D" . $game_info['id'];
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));
        }else if($type==12){
            //345游戏 
            $game_info = $game_model->findByPk($id);
            $url = $game_info['register_url']."userId=".$memid."&ext1=".$game_info['id'];
            $this->renderPartial('jump', array('url' => $url, "game_info" => $game_info, "type" => $type));

        }
    }

}

//if ($id == 478) { //凡凡棋牌
//                $ybhlb_model = new Ybhlb();
//                if (isset($_POST['Ybhlb'])) {
//                    foreach ($_POST['Ybhlb'] as $_k => $_v) {
//                        $ybhlb_model->$_k = strip_tags(trim($_v));
//                    }
//                    $memid = $ybhlb_model["mem_id"];
//                    if (!empty($memid)) {
//                        $title = "兑换凡凡元宝";
//                        $hlb = $ybhlb_model["ybnum"] * 8500; //兑换消耗的元宝
//                        $ybhlb_model->gold = $hlb;
//                        $hlbnum = Hlb::model()->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $memid);
//                        if ($hlbnum >= $hlb) {
//                            if ($ybhlb_model->save()) {
//                                $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=478 and  username='" . $ybhlb_model->username . "'");
//                                $sign = md5($gamezm_info["guid"] . $ybhlb_model["id"] . "duihuan!@#ex78" . $ybhlb_model["ybnum"] . $ybhlb_model["gold"] . "18");
//                                $url = "http://www.ff6677.com/swzc/tryother.aspx?userid=" . $gamezm_info["guid"] . "&recordid=" . $ybhlb_model["id"] . "&money=" . $ybhlb_model["ybnum"] . "&gold=" . $ybhlb_model["gold"] . "&type=18&sign=" . $sign;
//                                $res = file_get_contents($url);
//                                $result = substr($res, 10, -1);
//                                $data = json_decode($result);
//                                if ($data->Status == 1) {
//                                    $reason = $title . "消耗了" . $hlb . "元宝,共兑换了：" . $ybhlb_model["ybnum"] . "个元宝";
//                                    $hlb_model = $this->updhlb(-$hlb, 24, $reason, $memid, 0); //扣除元宝
//                                    $this->sendmessage($title, $reason, 1, $memid); //1为系统消息
//                                    $ybhlb_model->goldid = $hlb_model["id"];
//                                    $ybhlb_model->guid = $gamezm_info["guid"];
//                                    $ybhlb_model->username = $ybhlb_model["username"];
//                                    $ybhlb_model->status = "兑换成功";
//                                    Yii::app()->user->setFlash('msg', '兑换成功');
//                                } else {
//                                    $ybhlb_model->status = "兑换失败";
//                                    Yii::app()->user->setFlash('msg', '兑换失败,本次没有扣除元宝');
//                                }
//                                $ybhlb_model->update();
//                            }
//                        } else {
//                            Yii::app()->user->setFlash('msg', '元宝不足!');
//                        }
//                    } else {
//                        Yii::app()->user->setFlash('msg', '请先登录会员!');
//                    }
//                }
//                $ybhld_model = new Ybhld();
//                if (isset($_POST['Ybhld'])) {
//                    foreach ($_POST['Ybhld'] as $_k => $_v) {
//                        $ybhld_model->$_k = strip_tags(trim($_v));
//                    }
//                    $memid = $ybhld_model["mem_id"];
//                    if (!empty($memid)) {
//                        $title = "兑换凡凡元宝";
//                        $hld = $ybhld_model["ybnum"] * 11000;  //兑换消耗的牛毛
//                        $ybhld_model->gold = $hld;
//                        $hldnum = Hld::model()->countBySql("select sum(hld) from {{hld}} where mem_id=" . $memid);
//                        if ($hldnum >= $hld) {
//                            if ($ybhld_model->save()) {
//                                $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=478 and  username='" . $ybhld_model->username . "'");
//                                $sign = md5($gamezm_info["guid"] . $ybhld_model["id"] . "duihuan!@#ex78" . $ybhld_model["ybnum"] . $ybhld_model["gold"] . "18");
//                                $url = "http://www.ff6677.com/swzc/tryother.aspx?userid=" . $gamezm_info["guid"] . "&recordid=" . $ybhld_model["id"] . "&money=" . $ybhld_model["ybnum"] . "&gold=" . $ybhld_model["gold"] . "&type=18&sign=" . $sign;
//                                $res = file_get_contents($url);
//                                $result = substr($res, 10, -1);
//                                $data = json_decode($result);
//                                if ($data->Status == 1) {
//                                    $reason = $title . "消耗了" . $hld . "牛毛,共兑换了：" . $ybhld_model["ybnum"] . "个元宝";
//                                    $hld_model = $this->updhld(-$hld, 24, $reason, $memid, 0); //扣除元宝
//                                    $this->sendmessage($title, $reason, 1, $memid); //1为系统消息
//                                    $ybhld_model->goldid = $hld_model["id"];
//                                    $ybhld_model->guid = $gamezm_info["guid"];
//                                    $ybhld_model->username = $ybhld_model["username"];
//                                    $ybhld_model->status = "兑换成功";
//                                    Yii::app()->user->setFlash('msg', '兑换成功');
//                                } else {
//                                    $ybhld_model->status = "兑换失败";
//                                    Yii::app()->user->setFlash('msg', '兑换失败,本次没有扣除元宝');
//                                }
//                                $ybhld_model->update();
//                            }
//                        } else {
//                            Yii::app()->user->setFlash('msg', '牛毛不足!');
//                        }
//                    } else {
//                        Yii::app()->user->setFlash('msg', '请先登录会员!');
//                    }
//                }
//                $this->renderPartial('fanfan', array("data" => json_encode($rankdata), 'count' => intval($count), 'game_info' => $game_info, 'endtime' => $endtime, 'posts' => $posts, 'pages' => $pages, "ybhlb_model" => $ybhlb_model, "ybhld_model" => $ybhld_model));
    