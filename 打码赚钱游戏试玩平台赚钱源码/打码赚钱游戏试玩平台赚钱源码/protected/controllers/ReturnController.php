<?php

//放回数据
class ReturnController extends Controller {

    //获取玩游戏等级数据
//    function actionGrade() {
//        try {
//            $gamezm_infos = Gamezm::model()->findAllBySql("select * from xm_game_zm where gid=478 limit 50,50");
//            foreach ($gamezm_infos as $info) {
//                $gid = 478; //、游戏id
//                $guid =$info["guid"];
//                $game_info = Game::model()->findBySql("select * from {{game}} where id= " . $gid);
//                $url = str_replace("{guid}", $guid, $game_info['return_url']);
//                $result = file_get_contents($url);
//                $data = json_decode($result);
//                if (empty($data->error_code)) { //表示查询等级没有错误
//                 //   $gamezm_info = Gamezm::model()->findBySql("select * from {{game_zm}} where gid=" . $gid . " and guid=" . $data->uid);
//                    $level = $data->level;
//                    $memid = $info["mem_id"];
//                    $gameid = $info["gid"];
//                    $grade_model = Gamegrade::model();
//                    $gamedata_model = Gamedata::model();
//                    $gamegradata_model = Gamegradedata::model();
//                    $gamedata = $gamedata_model->findBySql("select * from {{game_data}} where  mem_id=" . $memid . " and game_id=" . $gameid);
//                    if (empty($gamedata)) {
//                        $gamedata_model = new Gamedata();
//                        $gamedata_model->mem_id = $memid;
//                        $gamedata_model->game_id = $gameid;
//                        $gamedata_model->guid = $info["guid"];
//                        $gamedata_model->username = $info["username"];
//                        $gamedata_model->servername = $data->servername;
//                        $gamedata_model->role = $data->role;
//                        $gamedata_model->level = $level;
//                        $gamedata_model->payment = $data->payment;
//                        $gamedata_model->update_time = date("Y-m-d H:i:s", time());
//                        $gamedata_model->save();
//                    } else {
//                        $gamedata->role = $data->role;
//                        $gamedata->level = $level;
//                        $gamedata->payment = $data->payment;
//                        $gamedata->update_time = date("Y-m-d H:i:s", time());
//                        $gamedata->update();
//                    }
//                    $gamegrade = $grade_model->findAllBySql("select * from {{game_grade}} where game_id= " . $gameid . " and level <=" . $level);
//                    if (!empty($gamegrade)) {
//                        foreach ($gamegrade as $grade) {
//                            $count = $gamegradata_model->countBySql("select count(*) from {{game_gradedata}} where  mem_id=" . $memid . " and game_id=" . $gameid . " and level=" . $grade["level"]);
//                            if (empty($count)) {
//                                $gamegradedata_model = new Gamegradedata();
//                                $gamegradedata_model->valid = 0; //表示未领取
//                                $gamegradedata_model->level = $grade["level"];
//                                $gamegradedata_model->mem_id = $memid;
//                                $gamegradedata_model->hlb = $grade["hlb"];
//                                $gamegradedata_model->game_id = $gameid;
//                                $gamegradedata_model->save();
//                            }
//                        }
//                    }
//                }
//            }
//        } catch (Exception $ex) {
//            echo $ex->getMessage();
//        }
//    }

    /*
     * 等级刷新
     */

//    function actionRefresh() {
//        $memid = (int) Yii::app()->request->getParam('memid');
//        $gameid = (int) Yii::app()->request->getParam('gameid');
//        $username = Yii::app()->request->getParam('username');
//        $postdata = array('memid' => $memid, 'username' => $username, "gameid" => $gameid);
//
//        $url = SITE_URL . "return/gameref";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url); //设置链接
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //设置是否返回信息
//        curl_setopt($ch, CURLOPT_POST, 1); //设置为POST方式
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); //POST数据
//        $response = curl_exec($ch); //接收返回信息
//        if (curl_errno($ch)) {//出错则显示错误信息
//            print curl_error($ch);
//        }
//        curl_close($ch); //关闭curl链
//        $data = json_decode($response);
//        $gamegrade = Gamegrade::model()->findAllBySql("select grade,hlb from xm_game_grade where game_id= " . $data->gameid . " and grade<=" . $data->level);
//        foreach ($gamegrade as $grade) {
//            $gamedata = Gamedata::model()->findBySql("select * from {{game_data}} where  mem_id=" . $data->memid . " and game_id=" . $data->gameid . " and level=" . $grade["grade"]);
//            if (empty($gamedata)) {
//                $gamedata_model = new Gamedata();
//                $gamedata_model->mem_id = $data->memid;
//                $gamedata_model->game_id = $data->gameid;
//                $gamedata_model->username = $data->username;
//                $gamedata_model->userserver = $data->userserver;
//                $gamedata_model->gamename = $data->gamename;
//                $gamedata_model->role = $data->role;
//                $gamedata_model->level = $grade["grade"];
//                $gamedata_model->level_jlhlb = $grade["hlb"];
//                $gamedata_model->save();
//            }
//        }
//        echo "等级刷新成功！";
//    }

    /*
     * 游戏试玩更新
     */

//    function actionGameref() {
//        $arr = array();
//        $arr["memid"] = $_POST["memid"];
//        $arr["gameid"] = $_POST["gameid"];
//        $arr["username"] = $_POST["username"]; //游戏账号
//        $arr["userserver"] = 1; //游戏区服
//        $arr["gamename"] = "77玩"; //游戏名称
//        $arr["role"] = "班长"; //游戏角色名称
//        $arr["level"] = 36; //游戏等级 
//        echo json_encode($arr);
//    }

    /*
     * 体验更新
     */

//    function actionExpadref() {
//        $arr = array();
//        $arr["memid"] = $_POST["memid"];
//        $arr["expadid"] = $_POST["expadid"];
//        $arr["username"] = $_POST["username"]; //游戏账号
//        $arr["level"] = 1; //游戏区服
//        // $arr["level_jlhlb"] = "77玩"; //游戏名称
//        echo json_encode($arr);
//    }

    /*
     * 排名奖励
     */

//    function actionRankrewards() {
//        //打码排名 update_time 更新的时间代表打码那天的数据
//        $rankrewardsinfo = Rankrewards::model()->findBySql("select * from {{rankrewards}}  WHERE  TO_DAYS(update_time) = (TO_DAYS(NOW())-1) and source=3"); //查询今天的数据是否已经更新 source=3代表打码
//        if (empty($rankrewardsinfo)) {
//            $sql = "select * from {{captcha_data}}  WHERE  TO_DAYS(create_time) = (TO_DAYS(NOW())-1)  group by mem_id order by SUM(rewards_hlb) desc limit 0,100";
//            $captchadata_info = Captchadata::model()->findAllBySql($sql);
//            $num = 0;
//            foreach ($captchadata_info as $info) {
//                ++$num; //排名
//                $infos = Rank::model()->findBySql("select rewards_hlb from {{rank}} where rank_type=3 and grade = " . $num);
//                $hlb = $infos['rewards_hlb'];
//                $memid = $info["mem_id"];
//                $content = $info["create_time"] . "打码排名(" . $num . ")奖励" . $hlb;
//                $this->updhlb($hlb, 5, $content, $memid, 0);
//                $this->sendmessage("打码排名奖励", $content, 1, $memid);
//            }
//            //打码排行代表已经更新过
//            $rankrewardsinfos = new Rankrewards();
//            $rankrewardsinfos["update_time"] = date("ymdhis", time() - (3600 * 24));
//            $rankrewardsinfos["source"] = 3;
//            $rankrewardsinfos->save();
//        }
//
//
//        //广告体验排行 update_time 更新的时间代表打码那天的数据
//        $rankrewardsinfo2 = Rankrewards::model()->findBySql("select * from {{rankrewards}}  WHERE   date_format(update_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m')  and source=2"); //查询上月的数据是否已经更新 source=2代表广告体验
//        if (empty($rankrewardsinfo2)) {
//            $sql2 = "SELECT * ,SUM(b.level_jlhlb) as hlb from (select * from xm_exp_ad_data as a where date_format(create_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m')) as b group by b.mem_id order by SUM(b.level_jlhlb) desc limit 0,100 ";
//            $expaddate_infos = Expaddata::model()->findAllBySql($sql2);
//            $num = 0;
//            foreach ($expaddate_infos as $info) {
//                ++$num; //排名
//                $infos = Rank::model()->findBySql("select rewards_hlb from {{rank}} where rank_type=2 and grade = " . $num);
//                $hlb = $infos['rewards_hlb'];
//                $memid = $info["mem_id"];
//                $content = $info["create_time"] . "广告体验排名(" . $num . ")奖励" . $hlb;
//                $this->updhlb($hlb, 5, $content, $memid, 0);
//                $this->sendmessage("广告体验排名奖励", $content, 1, $memid);
//            }
//            //打码排行代表已经更新过
//            $rankrewardsinfos = new Rankrewards();
//            $rankrewardsinfos["update_time"] = date('Y-m-01', strtotime('-1 month'));
//            $rankrewardsinfos["source"] = 2;
//            $rankrewardsinfos->save();
//        }
//
//
//        //游戏试玩排行 update_time 更新的时间代表打码那天的数据
//        $rankrewardsinfo3 = Rankrewards::model()->findBySql("select * from {{rankrewards}}  WHERE  TO_DAYS(update_time) = (TO_DAYS(NOW())-1) and source=1"); //查询今天的数据是否已经更新 source=1代表试玩游戏
//        if (empty($rankrewardsinfo)) {
//            $sql3 = "select mem_id ,SUM(hlb) as hlbnum from {{hlb}}  WHERE  TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and source=3 group by mem_id order by SUM(hlb) desc  limit 0,100";
//            $captchadata_info = Captchadata::model()->findAllBySql($sql);
//            $num = 0;
//            foreach ($captchadata_info as $info) {
//                ++$num; //排名
//                $infos = Rank::model()->findBySql("select rewards_hlb from {{rank}} where rank_type=3 and grade = " . $num);
//                $hlb = $infos['rewards_hlb'];
//                $memid = $info["mem_id"];
//                $content = $info["create_time"] . "排名(" . $num . ")奖励" . $hlb;
//                $this->updhlb($hlb, 5, $content, $memid, 0);
//                $this->sendmessage("排名奖励", $content, 1, $memid);
//            }
//            //打码排行代表已经更新过
//            $rankrewardsinfos = new Rankrewards();
//            $rankrewardsinfos["update_time"] = date("ymdhis", time() - (3600 * 24));
//            $rankrewardsinfos["source"] = 1;
//            $rankrewardsinfos->save();
//        }
//    }

    /*
     * 会员导入
     */

//    function actionMem() {
//        header("Content-Type: text/html; charset=utf-8");
//        $url = "http://009.90xqb.com:8080/get_user.asp";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch); //接收返回信息
//        if (curl_errno($ch)) {//出错则显示错误信息
//            print curl_error($ch);
//        }
//        $str = substr($response, 0, -2) . "]";
//        curl_close($ch); //关闭curl链
//        $data = json_decode($str, TRUE);
//        $count_json = count($data);
//
//        for ($i = 0; $i < $count_json; $i++) {
//            $mem_model = new Mem();
//            $mem_model->mem_name = $data[$i]['Mem_name'];
//            $mem_model->name = $data[$i]['name'];
//            if ($data[$i]['sex'] == 0) {
//                $mem_model->sex = "男";
//            } else {
//                $mem_model->sex = "女";
//            }
//            $mem_model->pid = $data[$i]['pid'];
//            if ($data[$i]['bank'] == "支付宝") {
//                $alipay_model = new Alipay();
//                $alipay_model->name = $data[$i]['name'];
//                $alipay_model->account = $data[$i]['bankID'];
//                $alipay_model->account2 = $data[$i]['bankID'];
//                $alipay_model->mem_id = $data[$i]['ID'];
//                $alipay_model->save();
//                $mem_model->alipayid = $alipay_model["id"];
//            } else if ($data[$i]['bank'] == "财付通") {
//                $treasure_model = new Treasure();
//                $treasure_model->name = $data[$i]['name'];
//                $treasure_model->account = $data[$i]['bankID'];
//                $treasure_model->account2 = $data[$i]['bankID'];
//                $treasure_model->mem_id = $data[$i]['ID'];
//                $treasure_model->save();
//                $mem_model->treasureid = $treasure_model["id"];
//            }
//            $memid = $data[$i]['ID'];
//            //元宝导入
//            $reason1 = "老平台元宝总额:" . $data[$i]['hlb'];
//            $this->updhlb($data[$i]['hlb'], 21, $reason1, $memid, 0);
//            $this->sendmessage("老平台元宝总额", $reason1, 1, $memid); //1为系统消息
//            //金豆导入
//            $reason2 = "老平台金豆总额:" . $data[$i]['hld'];
//            $this->updhld($data[$i]['hld'], 4, $reason2, $memid);
//            $this->sendmessage("老平台金豆总额", $reason2, 1, $memid); //1为系统消息
//            $mem_model->scdl_time = date("Y-m-d H:i:s", time());
//            $mem_model->pwd = $data[$i]['pwd'];
//            $mem_model->email = $data[$i]['email'];
//            $mem_model->qq = $data[$i]['qq'];
//            $mem_model->idcode = $data[$i]['idcode'];
//            $mem_model->phone = $data[$i]['phone'];
//            $mem_model->id = $data[$i]['ID'];
//            $mem_model->save();
//        }
//    }

    /*
     * 会员密码修改
     */

//    function actionMempwd() {
//        header("Content-Type: text/html; charset=utf-8");
//        $url = "http://009.90xqb.com:8080/get_user.asp";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch); //接收返回信息
//        if (curl_errno($ch)) {//出错则显示错误信息
//            print curl_error($ch);
//        }
//        $str = substr($response, 0, -2) . "]";
//        curl_close($ch); //关闭curl链
//        $data = json_decode($str, TRUE);
//        $count_json = count($data);
//        for ($i = 0; $i < $count_json; $i++) {
//            $mem_model = Mem::model()->findByPk($data[$i]['ID']);
//            $mem_model->pwd = $data[$i]['pwd'];
//            $mem_model->update();
//        }
//    }

    /*
     * 会员没有元宝
     */

//    function actionMemhlb() {
//        $mem_model = Mem::model()->findAll();
//        foreach ($mem_model as $mem){
//          $count=  Hlb::model()->countBySql("select count(*) from {{hlb}} where mem_id = ".$mem["id"]);
//          if(empty($count)){
//              echo $mem["id"]. "<br/>";
//          }
//        }
//    }




    /*
     * 游戏导入
     */

//    function actionGame() {
//        header("Content-Type: text/html; charset=utf-8");
//        $url = "http://009.90xqb.com:8080/get_gamelist.asp";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch); //接收返回信息
//        if (curl_errno($ch)) {//出错则显示错误信息
//            print curl_error($ch);
//        }
//        curl_close($ch); //关闭curl链
//        $data = json_decode($response, TRUE);
//        $count_json = count($data);
//        
//        for ($i = 0; $i < $count_json; $i++) {
//            $game_model = new Game();
//            $game_model->id = $data[$i]['id'];
//            $game_model->login_url = $data[$i]['url2'];
//            $game_model->begin_time = $data[$i]['st'];
//            $game_model->end_time = $data[$i]['ot'];
//            $game_model->zc_end_time = $data[$i]['rt'];
//            $game_model->name = $data[$i]['gn'];
//            $game_model->recruit_num = 1000; //默认1000人
//            if ($data[$i]['gt'] == 4) {
//                $game_model->game_type_id = 2;
//            } else {
//                $game_model->game_type_id = $data[$i]['gt'];
//            }
//            $game_model->save();
//            $hello = explode(',', $data[$i]['Step']); //按逗号分离字符串 
//            $L = explode(',', $data[$i]['L']);
//            for ($index = 0; $index < count($hello); $index++) {
//                if (!empty($L[$index])) {
//                    $gamegrade_model = new Gamegrade();
//                    $gamegrade_model->name = $L[$index] . "级";
//                    $gamegrade_model->level = $L[$index];
//                    $gamegrade_model->hlb = $hello[$index];
//                    $gamegrade_model->game_id = $data[$i]['id'];
//                    $gamegrade_model->save();
//                }
//            }
//        }
//    }   

    /*
     * 游戏数据导入
     */


    function actionGamedata() {
        $gamedata_model = Gamedata::model()->findAllBySql("select * from xm_game_data where game_id=478");
        foreach ($gamedata_model as $data) {
            $gamegrade_info = Gamegrade::model()->findAllBySql("select * from xm_game_grade where game_id=478 and level<= " . $data['level']);
            foreach ($gamegrade_info as $info) {
                $gamegradedata_model = new Gamegradedata();
                $gamegradedata_model->valid = 1; //表示已领取
                $gamegradedata_model->level = $info["level"];
                $gamegradedata_model->mem_id = $data['mem_id'];
                $gamegradedata_model->hlb = $info["hlb"];
                $gamegradedata_model->game_id = 478;
                $gamegradedata_model->save();
            }
        }
    }

//    function actionGamedata() {
//        header("Content-Type: text/html; charset=utf-8");
//        $url = "http://www.9200tv.com:81/get_game.asp";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($ch); //接收返回信息
//        if (curl_errno($ch)) {//出错则显示错误信息
//            print curl_error($ch);
//        }
//        $str = substr($response, 0, -2) . "]";
//        curl_close($ch); //关闭curl链
//        $data = json_decode($str, TRUE);
//        $count_json = count($data);
//        echo $count_json;
//        for ($i = 0; $i < $count_json; $i++) {
//            if ($data[$i]['level'] != -1 && !empty($data[$i]['level'])) {
//                $gamegrade_info = Gamegrade::model()->findAllBySql("select * from xm_game_grade where game_id=" . $data[$i]['game_id'] . " and level<= " . $data[$i]['level']);
//                foreach ($gamegrade_info as $info) {
//                    $gamegradedata_model = new Gamegradedata();
//                    $gamegradedata_model->valid = 0; //表示未领取
//                    $gamegradedata_model->level = $info["level"];
//                    $gamegradedata_model->mem_id = $data[$i]['mem_id'];
//                    $gamegradedata_model->hlb = $info["hlb"];
//                    $gamegradedata_model->game_id = $data[$i]['game_id'];
//                    $gamegradedata_model->save();
//                }
//                $gamedata_model = new Gamedata();
//                $gamedata_model->mem_id = $data[$i]['mem_id'];
//                $gamedata_model->game_id = $data[$i]['game_id'];
//                $gamedata_model->guid = $data[$i]['game2_id'];
//                $gamedata_model->username = $data[$i]['username'];
//                $gamedata_model->role = $data[$i]['role'];
//                $gamedata_model->level = $data[$i]['level'];
//                $gamedata_model->payment = 0;
//                $gamedata_model->save();
//                
//                $gamezm_model = new Gamezm();
//                $gamezm_model->mem_id = $data[$i]['mem_id'];
//                $gamezm_model->game_id = $data[$i]['game_id']; //、游戏id
//                $gamezm_model->guid = $data[$i]['game2_id'];
//                $gamezm_model->username = $data[$i]['username'];
//                $gamezm_model->cid = "1427179412";
//                $gamezm_model->save();
//            }
//        }
    //  }
    //获取37玩游戏数据
//    function actionGameall37() {
//        try {
//            $gamemodel = Game::model();
//            $ga = new GameAccess();
//            //取游戏列表
//            $game_list = $ga->getGameList();
//            foreach ($game_list as $info) {
//                $game_num = $gamemodel->countBySql("select count(*) from {{game}} where game_id=" . $info["id"]);
//                if (empty($game_num)) {
//                    $game_model = new Game();
//                    $game_model->game_id = $info["gid"]; //对方平台游戏id
//                    $game_model->name = $info["title"];
//                    $game_model->introduce = $info["description"];
//                    $game_model->login_url = $info["url"]; //继续游戏链接地址
//                    $game_model->begin_time = $info["start_date"];
//                    $game_model->end_time = $info["end_date"];
//                    $game_model->recruit_num = 1000; //设置默认值
//                    $game_model->game_type_id = 1; //默认为网页游戏
//                    $game_model->save();
//                    foreach ($info["level_list"] as $level) {
//                        $gamegrade_model = new Gamegrade();
//                        $gamegrade_model->name = $level["name"];
//                        $gamegrade_model->level = $level["level"];
//                        $gamegrade_model->money = $level["money"];
//                        $gamegrade_model->game_id = $game_model["id"];
//                        $gamegrade_model->save();
//                    }
//                }
//            }
//        } catch (Exception $ex) {
//            echo $ex->getMessage();
//        }
//    }
}














