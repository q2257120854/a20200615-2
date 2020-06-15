<?php

/*
 * 打码平台
 */

class CaptchaController extends Controller {
    
    
    /*
     * 展示
     */

    function actionShow() {
        //今日排名
        $sql1 = "select mem_id,SUM(rewards_hlb) as rewards_hlb from {{captcha_data}}   WHERE  TO_DAYS(create_time) = TO_DAYS(NOW()) and isjldata =0 GROUP BY mem_id order by SUM(rewards_hlb) desc ";
        //昨日排名
        $sql2 = "select mem_id,SUM(rewards_hlb) as rewards_hlb from {{captcha_data}}  WHERE  TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and isjldata =0  GROUP BY mem_id order by SUM(rewards_hlb) desc ";
        $data1 = array();
        $data2 = array();
        $captchadata_model = Captchadata::model();
        $mem_model = Mem::model();
        $rank_model = Rank::model();
        $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=3  and start='已开启' order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=3 and start='已开启' order by grade ");
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $captinfo1 = $captchadata_model->findBySql($sql1 . " limit " . $index . ",1");
            $memname1 = $mem_model->findByPk($captinfo1["mem_id"])->mem_name;
            $data1[$index][0] = $num;
            $data1[$index][1] = mb_substr($memname1, 0, 4, 'utf-8') . '**';
            $data1[$index][2] = number_format(intval($captinfo1["rewards_hlb"]));
            $data1[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
            //昨日数据
            $captinfo2 = $captchadata_model->findBySql($sql2 . " limit " . $index . ",1");
            $memname2 = $mem_model->findByPk($captinfo2["mem_id"])->mem_name;
            $data2[$index][0] = $num;
            $data2[$index][1] = mb_substr($memname2, 0, 4, 'utf-8') . '**';
            $data2[$index][2] = number_format(intval($captinfo2["rewards_hlb"]));
            $data2[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }
        $this->renderPartial('show', array("data1" => json_encode($data1), "data2" => json_encode($data2), "count" => intval($count)));
    }
  

    /*
     * 详细
     */

    function actionDetail($id) {
       //今日排名
        $sql1 = "select mem_id,SUM(rewards_hlb) as rewards_hlb from {{captcha_data}}   WHERE  TO_DAYS(create_time) = TO_DAYS(NOW()) and isjldata =0 GROUP BY mem_id order by SUM(rewards_hlb) desc ";
        //昨日排名
        $sql2 = "select mem_id,SUM(rewards_hlb) as rewards_hlb from {{captcha_data}}  WHERE  TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and isjldata =0  GROUP BY mem_id order by SUM(rewards_hlb) desc ";
        $data1 = array();
        $data2 = array();
        $captchadata_model = Captchadata::model();
        $mem_model = Mem::model();
        $rank_model = Rank::model();
        $rank_info = $rank_model->findAllBySql("select * from {{rank}} where rank_type=3 order by grade ");
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=3 order by grade ");
        foreach ($rank_info as $index => $rankinfo) {
            $num = $index + 1;
            $captinfo1 = $captchadata_model->findBySql($sql1 . " limit " . $index . ",1");
            $memname1 = $mem_model->findByPk($captinfo1["mem_id"])->mem_name;
            $data1[$index][0] = $num;
            $data1[$index][1] = substr_replace($memname1, '***', 4);
            $data1[$index][2] = number_format(intval($captinfo1["rewards_hlb"]));
            $data1[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
            //昨日数据
            $captinfo2 = $captchadata_model->findBySql($sql2 . " limit " . $index . ",1");
            $memname2 = $mem_model->findByPk($captinfo2["mem_id"])->mem_name;
            $data2[$index][0] = $num;
            $data2[$index][1] = substr_replace($memname2, '***', 4);
            $data2[$index][2] = number_format(intval($captinfo2["rewards_hlb"]));
            $data2[$index][3] = intval($rankinfo['rewards_hlb'] / 10000);
        }

        $captcha_model = Captcha::model();
        $captcha_info = $captcha_model->findByPk($id);
        $memid = $this->show_mem_id();
        if (!empty($id) && !empty($memid)) {
            $sql = " select * from {{captcha_data}} where name='" . $captcha_info["name"] . "' and mem_id=" . $memid;
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
        }
        $this->renderPartial('detail', array('captcha_info' => $captcha_info, 'posts' => $posts, 'pages' => $pages,"data1" => json_encode($data1), "data2" => json_encode($data2), "count" => intval($count)));
    }

    /*
     * 打码数据更新
     */

    function actionCaptchadata() {
        $id = intval($_GET["ID"]);
        $cid = intval($_GET["Cid"]);
        $xiangmu = urldecode($_GET["XiangMu"]);
        $isjiangli = intval($_GET["IsJiangLi"]); //'是否是奖励数据
        $pass = $_GET["Pass"];
        $key = "pnGL183OufSXNy3QRwcnbTpDkPMvmk6D"; //合作Key  
        // 先验证参数
        if (empty($id) || empty($pass)) {
            echo json_encode(array("status" => "failure", "errno" => 1001));
            return;
        }
        //在验证key （ID+Cid+IsJiangLi+Key）
        $mypass = md5($id . $cid . $isjiangli . $key);
        if ($mypass != $pass) {
            echo json_encode(array("status" => "failure", "errno" => 1002));
            return;
        }
        // 项目
        $captcha_info = Captcha::model()->findBySql("select * from {{captcha}} where name ='" . $xiangmu . "'");
        if (empty($captcha_info)) {
            echo json_encode(array("status" => "failure", "errno" => 1004));
            return;
        }
        $url = "http://daili.28bux.com/Connector/DaMaJieSuan.ashx?ID=" . $id . "&Uid=608";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch); //接收返回信息
        if (curl_errno($ch)) {//出错则显示错误信息
            print curl_error($ch);
        }
        curl_close($ch);
        //解析xml 
        $doc = new DOMDocument();
        $doc->loadXML($response);
        $xml = $doc->getElementsByTagName("ds");
        $captdata_model = Captchadata::model();
        $captzm_model = Captchazm::model();
        $mem_model = Mem::model();
        //cid为0表示实际打码结算数据 
        if (empty($cid)) {
            // $isjiangli=0表示是实际打码  
            if (empty($isjiangli)) {
                foreach ($xml as $value) { //item(1)结算id、item(3)打码工号、item(5)打码数量、item(7)打码佣金 
                    $captchadata_model = new Captchadata();
                    if (preg_match('/\d+/', $value->childNodes->item(3)->nodeValue, $arr)) {
                        $captchadata_model->mem_id = $arr[0]; //截取打码工号中的数字
                    }
                    $memid = $arr[0];
                    //$memnum为空表示不是我们平台的会员
                    $memnum = $mem_model->countBySql("select count(*) from {{mem}} where  id=" . $memid);
                    if (!empty($memnum)) {
                        //captnum为空表示刚更新数据,可以执行下面的排名奖励
                        $captnum = $captdata_model->countBySql("select count(*) from {{captcha_data}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())) and  mem_id=" . $memid . " and isjldata=" . $isjiangli . " and name='" . $xiangmu . "'");
                        if (!empty($captnum)) {
                            echo json_encode(array("status" => "failure", "errno" => 1005)); //只要有一条数据今天已经更新了  就终止程序
                            return;
                        }
                        //参与人数
                        $captzmnum = $captzm_model->countBySql("select count(*) from {{captcha_zm}} where   mem_id=" . $memid . " and captcha_id=" . $captcha_info["id"]);
                        if (empty($captzmnum)) {
                            $captchazm_model = new Captchazm();
                            $captchazm_model->mem_id = $memid;
                            $captchazm_model->captcha_id = $captcha_info["id"];
                            $captchazm_model->username = $value->childNodes->item(3)->nodeValue;
                            $captchazm_model->save();
                        }
                        $hlb = intval($value->childNodes->item(5)->nodeValue * $captcha_info["code_val"]);
                        if (!empty($hlb)) {
                            $captchadata_model->name = $captcha_info["name"];
                            $captchadata_model->num = $value->childNodes->item(5)->nodeValue;
                            $captchadata_model->rewards_hlb = $hlb;
                            $captchadata_model->code = $value->childNodes->item(3)->nodeValue;
                            $captchadata_model->code_val = $captcha_info["code_val"];
                            $captchadata_model->type = 1; //表示自动更新数据
                            $captchadata_model->js_id = $id; //结算id
                            $captchadata_model->dsf_money = $value->childNodes->item(7)->nodeValue;
                            $captchadata_model->isjldata = 0; //表示为实际打码数据
                            //奖励元宝
                            $title = "打码项目[" . $captcha_info["name"] . "]";
                            $content = $title . "，工号：" . $value->childNodes->item(3)->nodeValue . "，" . $value->childNodes->item(5)->nodeValue . "票奖励:" . $hlb;
                            $hlb_model = $this->updhlb($hlb, 5, $content, $memid, 0);
                            if (!empty($hlb)) {
                                $this->sendmessage($title, $content, 1, $memid);
                            }
                            //hlb ID 存入打码数据
                            $captchadata_model->hlb_id = $hlb_model["id"];
                            $captchadata_model->save();
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
                                                $rewadsmemhlb = $system_info['zzcaptcha1'];
                                                $title3 = $captcha_info["name"] . " 站长1级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['captcha1'];
                                                $title3 = $captcha_info["name"] . " 1级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            }
                                        } else if ($j == 2) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzcaptcha2'];
                                                $title3 = $captcha_info["name"] . " 站长2级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['captcha2'];
                                                $title3 = $captcha_info["name"] . " 2级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            }
                                        } else if ($j == 3) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzcaptcha3'];
                                                $title3 = $captcha_info["name"] . " 站长3级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['captcha3'];
                                                $title3 = $captcha_info["name"] . " 3级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            }
                                        } else if ($j == 4) {
                                            if (!empty($mem_info["role"])) {
                                                $rewadsmemhlb = $system_info['zzcaptcha4'];
                                                $title3 = $captcha_info["name"] . " 站长4级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            } else {
                                                $rewadsmemhlb = $system_info['captcha4'];
                                                $title3 = $captcha_info["name"] . " 4级好友(" . $mem_info["mem_name"] . ")领取打码奖励";
                                            }
                                        }

                                        $hlbsum = $hlb * ($rewadsmemhlb / 100);
                                        $content3 = $title3 . "奖" . $hlbsum . "元宝";
                                        $this->updhlb($hlbsum, 5, $content3, $array[$i], $memid);
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
                //存入更新时间
                if (!empty($captcha_info)) {
                    $captcha_info->update_time = date("Y-m-d H:i:s", time());
                    $captcha_info->update();
                }
            } else {
                //$isjiangli=1表示为奖励数据
                foreach ($xml as $value) {  //item(1)结算id、item(3)打码工号、item(5)打码数量、item(7)打码佣金 
                    $captchadata_model = new Captchadata();
                    if (preg_match('/\d+/', $value->childNodes->item(3)->nodeValue, $arr)) {
                        $captchadata_model->mem_id = $arr[0]; //截取打码工号中的数字
                    }
                    $memid = $arr[0];
                    //$memnum为空表示不是我们平台的会员
                    $memnum = $mem_model->countBySql("select count(*) from {{mem}} where  id=" . $memid);
                    if (!empty($memnum)) {
                        $num = $captdata_model->countBySql("select count(*) from {{captcha_data}} where  TO_DAYS(create_time) = (TO_DAYS(NOW())) and  mem_id=" . $memid . " and isjldata=" . $isjiangli . " and name='" . $xiangmu . "'");
                        if (!empty($num)) {
                            echo json_encode(array("status" => "failure", "errno" => 1005)); //只要有一条数据今天已经更新了  就终止程序
                            return;
                        }
                        $hlb = intval($value->childNodes->item(7)->nodeValue * 10000); //直接奖励金额乘以码值
                        if (!empty($hlb)) {
                            $captchadata_model->name = $captcha_info["name"];
                            $captchadata_model->num = 0; //奖励数据 没有打码
                            $captchadata_model->rewards_hlb = $hlb;
                            $captchadata_model->code = $value->childNodes->item(3)->nodeValue;
                            $captchadata_model->code_val = $captcha_info["code_val"];
                            $captchadata_model->type = 1; //表示自动更新数据
                            $captchadata_model->js_id = $id; //结算id
                            $captchadata_model->dsf_money = $value->childNodes->item(7)->nodeValue; //第三方佣金
                            $captchadata_model->isjldata = 1; //表示为奖励数据
                            //奖励元宝
                            $title = "打码项目[" . $captcha_info["name"] . "]";
                            $content = $title . "额外奖励：" . $hlb . "元宝";
                            $hlb_model = $this->updhlb($hlb, 5, $content, $memid, 0);
                            if (!empty($hlb)) {
                                $this->sendmessage($title, $content, 1, $memid);
                            }
                            //hlb ID 存入打码数据
                            $captchadata_model->hlb_id = $hlb_model["id"];
                            $captchadata_model->save();
                        }
                    }
                }
            }
        } else {
            //cid为1表示还原打码数据   只还原了自己的元宝 ,上级元宝没有还原
            if ($cid == 1 && empty($isjiangli)) {
                foreach ($xml as $value) { //item(1)结算id、item(3)打码工号、item(5)打码数量、item(7)打码佣金 
                    if (preg_match('/\d+/', $value->childNodes->item(3)->nodeValue, $arr)) {
                        $captchadata_model->mem_id = $arr[0]; //截取打码工号中的数字
                    }
                    $memid = $arr[0];
                    $captchadata_info = $captdata_model->findBySql("select * from {{captcha_data}} where TO_DAYS(create_time) = (TO_DAYS(NOW())) and mem_id =" . $memid . "  and name='" . $xiangmu . "'");
                    if (!empty($captchadata_info)) {
                        $hlb = intval($value->childNodes->item(5)->nodeValue * $captchadata_info["code_val"]); //直接打码数量乘以码值
                        if (!empty($hlb)) {
                            $captchadata_info->num = $value->childNodes->item(5)->nodeValue;
                            //打码数量
                            $captchadata_info->rewards_hlb = $hlb;
                            $captchadata_info->dsf_money = $value->childNodes->item(7)->nodeValue; //第三方佣金
                            $captchadata_info->update();
                            //更新元宝数量
                            $hlb_info = Hlb::model()->findByPk($captchadata_info["hlb_id"]);
                            $hlb_info->hlb = $hlb;
                            $hlb_info->update();
                        }
                    }
                }
            }
        }
        //返回回调成功
        echo json_encode(array("status" => "success", "errno" => 0));
    }

}
