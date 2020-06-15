<?php

/*
 * 游戏类型
 */

class GameController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', "export"),
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
        $sql = "SELECT * FROM {{game}} where 1=1";
        $sb = '';
        $name = null;
        if (isset($_GET['name']) || isset($_POST['name'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
            $sb = $sb . " and name like '%" . $name . "%' ";
        }
        $ID = null;
        if (isset($_GET['ID']) || isset($_POST['ID'])) {
            if (!empty($_POST['ID'])) {
                $ID = $_POST['ID'];
                $sb = $sb . " and  id =" . $ID;
            } else if (!empty($_GET['ID'])) {
                $ID = $_GET['ID'];
                $sb = $sb . " and  id =" . $ID;
            }
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($ID)) {
            $pages->params = array('name' => $name, "ID" => $ID);
        } else {
            $pages->params = array('name' => $name);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
      导出会员游戏数据
     */

    function actionExport($id) {
        //1.表头
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $header = array('A' => '、网络游戏ID', 'B' => '、网络会员ID', 'C' => '、网络会员账号', 'D' => '游戏商会员账号ID',
            'E' => '游戏商会员账号', 'F' => '等级', 'G' => '角色', 'H' => '充值金额');
        foreach ($header as $key => $value) {
            $excel->setActiveSheetIndex(0)->setCellValue($key . '1', $value);
            $excel->getActiveSheet()->getColumnDimension($key)->setWidth(30);
        }
        $n = 2; //行数开始位置
        $gamedata_info = Gamedata::model()->findAllBySql("select * from {{game_data}} where game_id=" . $id . " order by level desc ");
        if (!empty($gamedata_info)) {
            $mem_model = Mem::model();
            $gamezm_model = Gamezm::model();
            foreach ($gamedata_info as $data) {
                $mem_info = $mem_model->findByPk($data['mem_id']);
                $gamezm_info = $gamezm_model->findBySql("select * from {{game_zm}} where gid=" . $data["game_id"] . " and mem_id=" . $data["mem_id"]);
                $export_sheet = $excel->getActiveSheet();
                $export_sheet->setCellValueExplicit("A$n", (isset($data['game_id']) ? $data['game_id'] : ' '));
                $export_sheet->setCellValueExplicit("B$n", (isset($data["mem_id"]) ? $data["mem_id"] : ''));
                $export_sheet->setCellValueExplicit("C$n", (isset($mem_info['email']) ? $mem_info['email'] : ''));
                $export_sheet->setCellValueExplicit("D$n", (isset($gamezm_info['guid']) ? $gamezm_info['guid'] : ''));
                $export_sheet->setCellValueExplicit("E$n", (isset($gamezm_info['username']) ? $gamezm_info['username'] : ' '));
                $export_sheet->setCellValueExplicit("F$n", (isset($data['level']) ? $data['level'] : ' '));
                $export_sheet->setCellValueExplicit("G$n", (isset($data['role']) ? $data['role'] : ''));
                $export_sheet->setCellValueExplicit("H$n", (isset($data['payment']) ? $data['payment'] : ''));
                $n += 1;
            }
            // 3输出文件
            $export_sheet->getPageSetup()->setHorizontalCentered(true);
            $export_sheet->getPageSetup()->setVerticalCentered(false);
            ob_end_clean();
            ob_start();
            //导出Excel文件
            header('Content-Type: application/vnd.ms-excel;charset=utf-8');
            header('Content-Disposition:attachment;filename=' . urlencode('Game_' . date("YmjHis") . '.xls') . '');
            // 文件命名
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            $objWriter->save('php://output');
        }
    }

    /*
     * 添加
     */

    function actionAdd() {
        $gametype_model = Gametype::model();
        $gametype_info = $gametype_model->findAll();
        $gamearray = array();
        foreach ($gametype_info as $gametype) {
            $gamearray[$gametype['id']] = $gametype['name'];
        }
        $gamebus_model = Gamebus::model();
        $gamebus_info = $gamebus_model->findAll();
        $gamebusarray = array();
        foreach ($gamebus_info as $gamebusinfo) {
            $gamebusarray[$gamebusinfo['id']] = $gamebusinfo['name'];
        }

        $game_model = new Game();
        if (isset($_POST['Game'])) {
            foreach ($_POST['Game'] as $_k => $_v) {
                $game_model->$_k = $_v;
            }
           $game_model->cid= $gamebus_model->findByPk($game_model["bustype"])->cid;
            if (!empty($_POST["textimg"])) {
                $game_model->img = $_POST["textimg"];
            } else {
                $file = CUploadedFile::getInstance($game_model, 'img');
                if ($file) {
                    $newthumb = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb, FALSE);
                    $game_model->img = $newthumb;
                }
            }
            if (!empty($_POST["textbg_img"])) {
                $game_model->img = $_POST["textbg_img"];
            } else {
                $file2 = CUploadedFile::getInstance($game_model, 'bg_img');
                if ($file2) {
                    $newthumb2 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file2->extensionName;
                    $file2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb2, FALSE);
                    $game_model->bg_img = $newthumb2;
                }
            }
            if (!empty($_POST["textbusinessimg"])) {
                $game_model->img = $_POST["textbusinessimg"];
            } else {
                $file3 = CUploadedFile::getInstance($game_model, 'businessimg'); //商家图片
                if ($file3) {
                    $newthumb3 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file3->extensionName;
                    $file3->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb3, FALSE);
                    $game_model->businessimg = $newthumb3;
                }
            }
            if (!empty($_POST["textlogoimg"])) {
                $game_model->img = $_POST["textlogoimg"];
            } else {
                $file4 = CUploadedFile::getInstance($game_model, 'logoimg'); //商家图片
                if ($file4) {
                    $newthumb4 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file4->extensionName;
                    $file4->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb4, FALSE);
                    $game_model->logoimg = $newthumb4;
                }
            }
            if (!empty($_POST["textphotos1"])) {
                $game_model->img = $_POST["textphotos1"];
            } else {
                $files1 = CUploadedFile::getInstance($game_model, 'photos1'); //游戏截图
                if ($files1) {
                    $newthumbs1 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files1->extensionName;
                    $files1->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs1, FALSE);
                    $game_model->photos1 = $newthumbs1;
                }
            }
            if (!empty($_POST["textphotos2"])) {
                $game_model->img = $_POST["textphotos2"];
            } else {
                $files2 = CUploadedFile::getInstance($game_model, 'photos2'); //游戏截图
                if ($files2) {
                    $newthumbs2 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files2->extensionName;
                    $files2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs2, FALSE);
                    $game_model->photos2 = $newthumbs2;
                }
            }
            if (!empty($_POST["textphotos3"])) {
                $game_model->img = $_POST["textphotos3"];
            } else {
                $files3 = CUploadedFile::getInstance($game_model, 'photos3'); //游戏截图
                if ($files3) {
                    $newthumbs3 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files3->extensionName;
                    $files3->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs3, FALSE);
                    $game_model->photos3 = $newthumbs3;
                }
            }
            if (!empty($_POST["textphotos4"])) {
                $game_model->img = $_POST["textphotos4"];
            } else {
                $files4 = CUploadedFile::getInstance($game_model, 'photos4'); //游戏截图
                if ($files4) {
                    $newthumbs4 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files4->extensionName;
                    $files4->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs4, FALSE);
                    $game_model->photos4 = $newthumbs4;
                }
            }
            if (!empty($_POST["textphotos5"])) {
                $game_model->img = $_POST["textphotos5"];
            } else {
                $files5 = CUploadedFile::getInstance($game_model, 'photos5'); //游戏截图
                if ($files5) {
                    $newthumbs5 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files5->extensionName;
                    $files5->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs5, FALSE);
                    $game_model->photos5 = $newthumbs5;
                }
            }
            if (!empty($_POST["textphotos6"])) {
                $game_model->img = $_POST["textphotos6"];
            } else {
                $files6 = CUploadedFile::getInstance($game_model, 'photos6'); //游戏截图
                if ($files6) {
                    $newthumbs6 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files6->extensionName;
                    $files6->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs6, FALSE);
                    $game_model->photos6 = $newthumbs6;
                }
            }
            if (!empty($_POST["textphotos7"])) {
                $game_model->img = $_POST["textphotos7"];
            } else {
                $files7 = CUploadedFile::getInstance($game_model, 'photos7'); //游戏截图
                if ($files7) {
                    $newthumbs7 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files7->extensionName;
                    $files7->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs7, FALSE);
                    $game_model->photos7 = $newthumbs7;
                }
            }
            if (!empty($_POST["textphotos8"])) {
                $game_model->img = $_POST["textphotos8"];
            } else {
                $files8 = CUploadedFile::getInstance($game_model, 'photos8'); //游戏截图
                if ($files8) {
                    $newthumbs8 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files8->extensionName;
                    $files8->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs8, FALSE);
                    $game_model->photos8 = $newthumbs8;
                }
            }
            if ($game_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->render('add', array('game_model' => $game_model, 'result' => $result, 'gamearray' => $gamearray, 'gamebusarray' => $gamebusarray));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $gametype_model = Gametype::model();
        $gametype_info = $gametype_model->findAll();
        $gamearray = array();
        foreach ($gametype_info as $gametype) {
            $gamearray[$gametype['id']] = $gametype['name'];
        }
        $gamebus_model = Gamebus::model();
        $gamebus_info = $gamebus_model->findAll();
        $gamebusarray = array();
        foreach ($gamebus_info as $gamebusinfo) {
            $gamebusarray[$gamebusinfo['id']] = $gamebusinfo['name'];
        }
        $game_model = Game::model();
        $game_info = $game_model->findByPk($id);
        if (isset($_POST['Game'])) {
            foreach ($_POST['Game'] as $_k => $_v) {
                $game_info->$_k = $_v;
            }
            $game_info->cid= $gamebus_model->findByPk($game_info["bustype"])->cid;
            if (!empty($_POST["textimg"])) {
                $game_model->img = $_POST["textimg"];
            } else {
                $file = CUploadedFile::getInstance($game_info, 'img');
                if ($file) {
                    $newthumb = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file->extensionName;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb, FALSE);
                    $game_info->img = $newthumb;
                } else {
                    $game_info->img = $_POST['hideimg'];
                }
            }
            if (!empty($_POST["textbg_img"])) {
                $game_model->img = $_POST["textbg_img"];
            } else {
                $file2 = CUploadedFile::getInstance($game_info, 'bg_img');
                if ($file2) {
                    $newthumb2 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file2->extensionName;
                    $file2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb2, FALSE);
                    $game_info->bg_img = $newthumb2;
                } else {
                    $game_info->bg_img = $_POST['hidebgimg'];
                }
            }
            if (!empty($_POST["textbusinessimg"])) {
                $game_model->img = $_POST["textbusinessimg"];
            } else {
                $file3 = CUploadedFile::getInstance($game_info, 'businessimg');
                if ($file3) {
                    $newthumb3 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file3->extensionName;
                    $file3->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb3, FALSE);
                    $game_info->businessimg = $newthumb3;
                } else {
                    $game_info->businessimg = $_POST['hidebusinessimg'];
                }
            }
            if (!empty($_POST["textlogoimg"])) {
                $game_model->img = $_POST["textlogoimg"];
            } else {
                $file4 = CUploadedFile::getInstance($game_info, 'logoimg');
                if ($file4) {
                    $newthumb4 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $file4->extensionName;
                    $file4->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumb4, FALSE);
                    $game_info->logoimg = $newthumb4;
                } else {
                    $game_info->logoimg = $_POST['hidelogoimg'];
                }
            }
            if (!empty($_POST["textphotos1"])) {
                $game_model->img = $_POST["textphotos1"];
            } else {
                $files1 = CUploadedFile::getInstance($game_model, 'photos1'); //游戏截图
                if ($files1) {
                    $newthumbs1 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files1->extensionName;
                    $files1->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs1, FALSE);
                    $game_info->photos1 = $newthumbs1;
                } else {
                    $game_info->photos1 = $_POST['hidephotos1'];
                }
            }
            if (!empty($_POST["textphotos2"])) {
                $game_model->img = $_POST["textphotos2"];
            } else {
                $files2 = CUploadedFile::getInstance($game_model, 'photos2'); //游戏截图
                if ($files2) {
                    $newthumbs2 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files2->extensionName;
                    $files2->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs2, FALSE);
                    $game_info->photos2 = $newthumbs2;
                } else {
                    $game_info->photos2 = $_POST['hidephotos2'];
                }
            }
            if (!empty($_POST["textphotos3"])) {
                $game_model->img = $_POST["textphotos3"];
            } else {
                $files3 = CUploadedFile::getInstance($game_model, 'photos3'); //游戏截图
                if ($files3) {
                    $newthumbs3 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files3->extensionName;
                    $files3->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs3, FALSE);
                    $game_info->photos3 = $newthumbs3;
                } else {
                    $game_info->photos3 = $_POST['hidephotos3'];
                }
            }
            if (!empty($_POST["textphotos4"])) {
                $game_model->img = $_POST["textphotos4"];
            } else {
                $files4 = CUploadedFile::getInstance($game_model, 'photos4'); //游戏截图
                if ($files4) {
                    $newthumbs4 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files4->extensionName;
                    $files4->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs4, FALSE);
                    $game_info->photos4 = $newthumbs4;
                } else {
                    $game_info->photos4 = $_POST['hidephotos4'];
                }
            }
            if (!empty($_POST["textphotos5"])) {
                $game_model->img = $_POST["textphotos5"];
            } else {
                $files5 = CUploadedFile::getInstance($game_model, 'photos5'); //游戏截图
                if ($files5) {
                    $newthumbs5 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files5->extensionName;
                    $files5->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs5, FALSE);
                    $game_info->photos5 = $newthumbs5;
                } else {
                    $game_info->photos5 = $_POST['hidephotos5'];
                }
            }
            if (!empty($_POST["textphotos6"])) {
                $game_model->img = $_POST["textphotos6"];
            } else {
                $files6 = CUploadedFile::getInstance($game_model, 'photos6'); //游戏截图
                if ($files6) {
                    $newthumbs6 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files6->extensionName;
                    $files6->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs6, FALSE);
                    $game_info->photos6 = $newthumbs6;
                } else {
                    $game_info->photos6 = $_POST['hidephotos6'];
                }
            }
            if (!empty($_POST["textphotos7"])) {
                $game_model->img = $_POST["textphotos7"];
            } else {
                $files7 = CUploadedFile::getInstance($game_model, 'photos7'); //游戏截图
                if ($files7) {
                    $newthumbs7 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files7->extensionName;
                    $files7->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs7, FALSE);
                    $game_info->photos7 = $newthumbs7;
                } else {
                    $game_info->photos7 = $_POST['hidephotos7'];
                }
            }
            if (!empty($_POST["textphotos8"])) {
                $game_model->img = $_POST["textphotos8"];
            } else {
                $files8 = CUploadedFile::getInstance($game_model, 'photos8'); //游戏截图
                if ($files8) {
                    $newthumbs8 = '44wl_' . time() . '_' . rand(1, 9999) . '.' . $files8->extensionName;
                    $files8->saveAs(Yii::getPathOfAlias('webroot') . '/uploads/img/game/' . $newthumbs8, FALSE);
                    $game_info->photos8 = $newthumbs8;
                } else {
                    $game_info->photos8 = $_POST['hidephotos8'];
                }
            }
            if ($game_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->render('edit', array('game_model' => $game_info, 'result' => $result, 'gamearray' => $gamearray, 'gamebusarray' => $gamebusarray));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $game_model = Game::model();
        $game_info = $game_model->findByPk($id);
        $gamezm_model = Gamezm::model();
        $count = $gamezm_model->countBySql("select count(*) from {{game_zm}} where gid=" . $id);
        if (empty($count)) {
            if ($game_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
                $this->redirect("../../show");
            }
        } else {
            Yii::app()->user->setFlash('msg', '玩家正在试玩,不能删除！');
            $this->redirect("../../show");
        }
    }

}
