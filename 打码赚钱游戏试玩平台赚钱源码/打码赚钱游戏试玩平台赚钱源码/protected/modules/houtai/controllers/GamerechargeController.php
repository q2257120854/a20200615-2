<?php

/*
 * 充值返利
 */

class GamerechargeController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'alldel', "import"),
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
        $sql = "SELECT * FROM {{game_recharge}} where 1=1 ";
        $sb = '';
        $game_id = null;
        if (isset($_GET['game_id']) || isset($_POST['game_id'])) {
            if (!empty($_POST['game_id'])) {
                $game_id = $_POST['game_id'];
            } else if (!empty($_GET['game_id'])) {
                $game_id = $_GET['game_id'];
            }
            if (!empty($game_id)) {
                $sb = $sb . " and game_id  =" . $game_id;
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($game_id)) {
            $pages->params = array('game_id' => $game_id);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gamerechargemodel = Gamerecharge::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $gamedata_info = $gamerechargemodel->findByPk($id);
            if ($gamedata_info->delete()) {
                Hlb::model()->deleteByPk($gamedata_info["hlb_id"]);
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

    /*
      导入Excel数据
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
                $this->redirect(SITE_URL . 'houtai/gamerecharge/show');
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
                    $excelData[$i][1] = $valB; // iconv('utf-8', 'gb2312', $valA);
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
                    $valF = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65, $currentRow)->getValue(); /* ord()将字符转为十进制数 */
                    $excelData[$i][5] = $valF; // iconv('utf-8', 'gb2312', $valA);
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
        for ($k = 0; $k < $allRow; $k++) {
            $game_info = Game::model()->findByPk($excelData[$k][0]);
            if (!empty($game_info)) {
                $memid = $excelData[$k][6];
                $hlb = $excelData[$k][7] * ($game_info["cz_rewards_num"] / 100);
                $gamerecharge_model = new Gamerecharge();
                $gamerecharge_model->game_id = $excelData[$k][0];
                $gamerecharge_model->gamename = $excelData[$k][1];
                $gamerecharge_model->username = $excelData[$k][2];
                $gamerecharge_model->role = $excelData[$k][3];
                $gamerecharge_model->level = $excelData[$k][4];
                $gamerecharge_model->userserver = $excelData[$k][5];
                $gamerecharge_model->mem_id = $memid;
                $gamerecharge_model->hlb = $hlb;
                //调用save()方法实现数据添加
                if ($gamerecharge_model->save()) {
                    $title = $excelData[$k][1] . "游戏,您充值!" . $excelData[$k][7];
                    $content = "玩" . $title;
                    $hlb_model = $this->updhlb($hlb, 12, $content, $memid, 0);
                    $this->sendmessage($title, $content, 1, $memid);
                    //存入元宝id
                    $gamerecharge_model->hlb_id = $hlb_model["id"];
                    $gamerecharge_model->update();
                    $flag = TRUE;
                }
            }
        }
        if ($flag == TRUE) {
            Yii::app()->user->setFlash('msg', '导入成功');
            $this->redirect(SITE_URL . 'houtai/gamerecharge/show');
        } else {
            Yii::app()->user->setFlash('msg', '导入失败,excel文件数据不正确');
            $this->redirect(SITE_URL . 'houtai/gamerecharge/show');
        }
    }

}
