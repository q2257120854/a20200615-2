<?php

/*
 * 打码数据管理
 */

class CaptchadataController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'alldel', "import", "rank", "updhlb"),
                'expression' => 'Yii::app()->admin->isAdmin()',
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
        $sql = "SELECT * FROM {{captcha_data}} where 1=1 ";
        $sb = '';
        $captcha_id = null;
        if (isset($_GET['captcha_id']) || isset($_POST['captcha_id'])) {
            if (!empty($_POST['captcha_id'])) {
                $captcha_id = $_POST['captcha_id'];
            } else if (!empty($_GET['captcha_id'])) {
                $captcha_id = $_GET['captcha_id'];
            }
            if (!empty($captcha_id)) {
                $sb = $sb . " and captcha_id  =" . $captcha_id;
            }
        }
        $start = null;
        $end = null;
        if (!empty($_POST['end'])) {
            $end = $_POST['end'];
        } else if (!empty($_GET['end'])) {
            $end = $_GET['end'];
        }
        if (!empty($_POST['start'])) {
            $start = $_POST['start'];
        } else if (!empty($_GET['start'])) {
            $start = $_GET['start'];
        }
        if (!empty($end)) {
            if (!empty($start)) {
                $sb = $sb . " and create_time  between  '" . $start . " 00:00' and '" . $end . " 23:59'";
            } else {
                $sb = $sb . " and create_time  between  '" . date("Y-m-d") . " 00:00' and '" . $end . " 23:59'";
            }
        } else {
            if (!empty($start)) {
                $sb = $sb . " and create_time  <= '" . $start . " 23:59'";
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('start' => $start, 'end' => $end, 'captcha_id' => $captcha_id);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 操作元宝
     */

    function actionUpdhlb($id) {
        $captchadata_model = Captchadata::model();
        $captchadata_info = $captchadata_model->findByPk($id);
        if (!empty($captchadata_info)) {
            $memid = $captchadata_info["mem_id"];
            $hlb_model = new Hlb();
            $hlbnum = $hlb_model->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $memid);
            if (isset($_POST['Hlb'])) {
                foreach ($_POST['Hlb'] as $_k => $_v) {
                    $hlb_model->$_k = strip_tags($_v);
                }
                $title = "打码数据异常!";
                if ($hlb_model["type"] == 2) {
                    $hlb_model->hlb = -$hlb_model["hlb"]; //扣除元宝
                    $hlb_model->type = 2;
                    $content = $title . "管理员扣除" . $hlb_model["hlb"] . "元宝！";
                } else {
                    $hlb_model->type = 1; //增加元宝
                    $content = $title . "管理员增加" . $hlb_model["hlb"] . "元宝！";
                }
                $hlb_model->source = 5; //消耗元宝来源--提现
                $hlb_model->reason = $content; //元宝更改原因
                $hlb_model->mem_id = $memid;
                $hlb_model->pmem_id = 0;
                if ($hlb_model->save()) {
                    if ($hlb_model["type"] == 1) {
                        Yii::app()->user->setFlash('msg', '增加元宝成功！');
                    } else {
                        Yii::app()->user->setFlash('msg', '扣除元宝成功！');
                    }
                    $this->sendmessage($title, $content, 1, $memid);
                    $result = "success";
                }
            }
            $this->renderPartial('hlb', array('hlb_model' => $hlb_model, 'captchadata_info' => $captchadata_info, "hlbnum" => $hlbnum, 'result' => $result));
        }
    }

    //更新昨日奖励
    function actionRank() {
        $rank_model = Rank::model();
        $count = $rank_model->countBySql("select count(*) from {{rank}} where rank_type=3 and start='已开启' "); //获取设置排名的数量
        $captchadata_model = Captchadata::model();
        $num = $captchadata_model->countBySql("select count(*) from {{captcha_data}} where TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and rankrewards !=0");  //0表示没有更新
        if (empty($num)) {
            $sql = "select mem_id,SUM(rewards_hlb) as rewards_hlb,id  from xm_captcha_data   WHERE  TO_DAYS(create_time) = (TO_DAYS(NOW())-1) and isjldata =0   GROUP BY mem_id order by SUM(rewards_hlb) desc limit " . intval($count);
            $captd_info = $captchadata_model->findAllBySql($sql);
            foreach ($captd_info as $index => $captdinfo) {
                $rank_info = $rank_model->findBySql("select rewards_hlb from {{rank}} where rank_type=3 and grade=" . ($index + 1));
                if (!empty($rank_info)) {
                    $captchadata_info = $captchadata_model->findByPk($captdinfo["id"]);
                    $captchadata_info->rankrewards = $rank_info["rewards_hlb"];
                    $captchadata_info->update();
                    //奖励元宝
                    $title = "打码排名更新!";
                    $content = $title . "排名第" . ($index + 1) . "名,获得元宝:" . $rank_info["rewards_hlb"];
                    $this->updhlb($rank_info["rewards_hlb"], 5, $content, $captdinfo["mem_id"], 0);
                    $this->sendmessage($title, $content, 1, $captdinfo["mem_id"]);
                }
            }
            Yii::app()->user->setFlash('msg', '昨日打码排行更新成功');
        } else {
            Yii::app()->user->setFlash('msg', '昨日打码排行已经更新了');
        }
        $this->redirect("show");
    }

    /*
      导入打码数据
     */

    function actionImport() {
        $filePath = $_FILES['batchFile']['tmp_name'];
        $PHPExcel = new PHPExcel();
        /** 默认用excel2007读取excel，若格式不对，则用之前的版本进行读取 */
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filePath)) {
                Yii::app()->user->setFlash('msg', '请上传excel文件');
                $this->redirect(SITE_URL . 'houtai/captchadata/show');
                return;
            }
        }
        $PHPExcel = $PHPReader->load($filePath);
        /* 读取excel文件中的第一个工作表 */
        $currentSheet = $PHPExcel->getSheet(0);
        /* 取得最大的列号 */
        $allColumn = $currentSheet->getHighestColumn();
        /* 取得一共有多少行 */
        $allRow = $currentSheet->getHighestRow();
        //定义数组
        $excelData = array();
        $i = 0;
        /* 从第二行开始输出，因为excel表中第一行为列名 */
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                if ($currentColumn == 'A') {
                    $valA = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][0] = $valA; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'B') {
                    $valB = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][1] = $valB;
                }
                if ($currentColumn == 'C') {
                    $valC = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][2] = $valC; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'D') {
                    $valD = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][3] = $valD; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'E') {
                    $valE = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][4] = $valE; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'F') {
                    //  $valF = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][5] = $excelData[$i][3] * $excelData[$i][4]; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'G') {
                    $valG = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][6] = $valG; // iconv('utf-8', 'gb2312', $valA);
                }
                if ($currentColumn == 'H') {
                    $valH = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][7] = $valH; // iconv('utf-8', 'gb2312', $valA);
                }
            }
            $i++;
        }
        $flag = FALSE;
        for ($k = 0; $k < ($allRow - 1); $k++) {
            $captchadata_model = new Captchadata();
            $memid = $excelData[$k][0];
            $hlb = intval($excelData[$k][5]);
            $captchadata_model->mem_id = $memid;
            $captchadata_model->name = $excelData[$k][1];
            $captchadata_model->code = $excelData[$k][2];
            $captchadata_model->num = $excelData[$k][3];
            $captchadata_model->code_val = $excelData[$k][4];
            $captchadata_model->rewards_hlb = $hlb;
            $captchadata_model->dsf_money = $excelData[$k][6];
            $captchadata_model->js_id = $excelData[$k][7];
            $captchadata_model->isjldata = 0; //表示打码数据
            $captchadata_model->type = 2; //表示手动更新数据
            //
            //奖励元宝
            $title = "打码项目[" . $excelData[$k][1] . "]";
            $content = $title . "，工号：" . $excelData[$k][2] . "，" . $excelData[$k][3] . "票奖励:" . $hlb;

            $hlb_model = $this->updhlb($hlb, 5, $content, $memid, 0);
            $this->sendmessage($title, $content, 1, $memid);
            //hlb ID 存入打码数据
            $captchadata_model->hlb_id = $hlb_model["id"];
            //调用save()方法实现数据添加
            if ($captchadata_model->save()) {
                $flag = TRUE;
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
                                $rewadsmemhlb = $system_info['game1'];
                            } else if ($j == 2) {
                                $rewadsmemhlb = $system_info['game2'];
                            } else if ($j == 3) {
                                $rewadsmemhlb = $system_info['game3'];
                            } else if ($j == 4) {
                                $rewadsmemhlb = $system_info['game4'];
                            }
                            $title3 = $captchadata_model->name . "会员" . Mem::model()->findByPk($memid)->mem_name . "打码" . $captchadata_model->num . "个，所得返利！";
                            $content3 = "打码平台," . $title3;
                            $hlbsum = $hlb * ($rewadsmemhlb / 100);
                            if (!empty($hlbsum)) {
                                $this->updhlb($hlbsum, 5, $content3, $array[$i], $memid);
                                $this->sendmessage($title3, $content3, 1, $array[$i]);
                            }
                        }
                        $j++;
                    }
                }
            }
        }
        if ($flag == TRUE) {
            Yii::app()->user->setFlash('msg', '导入成功');
            $this->redirect(SITE_URL . 'houtai/captchadata/show');
        } else {
            Yii::app()->user->setFlash('msg', '导入失败,excel文件数据不正确');
            $this->redirect(SITE_URL . 'houtai/captchadata/show');
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $captchadata_model = Captchadata::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $captchadata_info = $captchadata_model->findByPk($id);
            if ($captchadata_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
