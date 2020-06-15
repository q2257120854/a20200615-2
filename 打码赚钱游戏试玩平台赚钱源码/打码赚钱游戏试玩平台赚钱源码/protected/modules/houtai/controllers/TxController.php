<?php

/*
 * 提现管理
 */

class TxController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是Administrator的用户
                'actions' => array('agree', 'refuse', 'show', 'alldel', "export", "rewards", "detail"),
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
        $sql = "SELECT * FROM {{tx}} where 1=1 ";
        $sb = '';
        $name = null;
        $starts = null;
        if (isset($_GET['name']) || isset($_POST['name'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
            $sb = $sb . " and name like '%" . $name . "%' ";
        }
        if (isset($_GET['starts']) || isset($_POST['starts'])) {
            if (!empty($_POST['starts'])) {
                $starts = $_POST['starts'];
            } else if (!empty($_GET['starts'])) {
                $starts = $_GET['starts'];
            }
            $sb = $sb . " and starts like '%" . $starts . "%' ";
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
        $pages->params = array('start' => $start, 'end' => $end, 'name' => $name, "starts" => $starts);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 交易明细
     */

    function actionDetail($memid) {
        $sql = "SELECT * FROM {{vipmessage}} where vipmessage_type=1 and mem_id =" . $memid;
        $sb = '';
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
        $pages->pageSize = 50;
        $pages->params = array('start' => $start, 'end' => $end, "memid" => $memid);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('detail', array('posts' => $posts, 'pages' => $pages, "memid" => $memid));
    }

    /*
      导出Excel文件数据
     */

    function actionExport() {
        //1.表头
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $header = array('A' => '用户名', 'B' => '账户类型', 'C' => '账号', 'D' => '姓名',
            'E' => '支付金额', 'F' => '身份证号码', 'G' => '申请时间', 'H' => '支付时间');
        foreach ($header as $key => $value) {
            $excel->setActiveSheetIndex(0)->setCellValue($key . '1', $value);
            $excel->getActiveSheet()->getColumnDimension($key)->setWidth(30);
        }
        $n = 2; //行数开始位置
        $tx_model = Tx::model();
        $sql = "SELECT * FROM {{tx}} where 1=1 ";
        $sb = '';
        $name = null;
        $start = null;
        $end = null;
        $starts = null; //状态
        if (isset($_GET['name']) || isset($_POST['name'])) {
            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            } else if (!empty($_GET['name'])) {
                $name = $_GET['name'];
            }
            $sb = $sb . " and name like '%" . $name . "%' ";
        }
        if (isset($_GET['starts']) || isset($_POST['starts'])) {
            if (!empty($_POST['starts'])) {
                $starts = $_POST['starts'];
            } else if (!empty($_GET['starts'])) {
                $starts = $_GET['starts'];
            }
            $sb = $sb . " and starts like '%" . $starts . "%' ";
        }
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
        $num = $tx_model->countBySql($sql);
        $tx_info = $tx_model->findAllBySql($sql);
        if (empty($num)) {
            Yii::app()->user->setFlash('msg', '请查询您需要的订单');
            $this->redirect('./show');
        } else {
            foreach ($tx_info as $data) {
                $mem_info = Mem::model()->findByPk($data['mem_id']);
                $export_sheet = $excel->getActiveSheet();
                $export_sheet->setCellValueExplicit("A$n", (isset($mem_info['mem_name']) ? $mem_info['mem_name'] : ' '));
                $export_sheet->setCellValueExplicit("B$n", (isset($data["way"]) ? $data["way"] : ''));
                $export_sheet->setCellValueExplicit("C$n", (isset($data['account']) ? $data['account'] : ''));
                $export_sheet->setCellValueExplicit("D$n", (isset($data['name']) ? $data['name'] : ''));
                $export_sheet->setCellValue("E$n", (isset($data['money']) ? $data['money'] : ' '));
                $export_sheet->setCellValueExplicit("F$n", (isset($mem_info['idcode']) ? $mem_info['idcode'] : ' '));
                $export_sheet->setCellValueExplicit("G$n", (isset($data['create_time']) ? $data['create_time'] : ''));
                $export_sheet->setCellValueExplicit("H$n", (isset($data['cl_time']) ? $data['cl_time'] : ''));
                $n += 1;
            }
            // 3输出文件
            $export_sheet->getPageSetup()->setHorizontalCentered(true);
            $export_sheet->getPageSetup()->setVerticalCentered(false);
            ob_end_clean();
            ob_start();
            //导出Excel文件
            header('Content-Type: application/vnd.ms-excel;charset=utf-8');
            header('Content-Disposition:attachment;filename=' . urlencode('Pay_' . date("YmjHis") . '.xls') . '');
            // 文件命名
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
            $objWriter->save('php://output');
        }
    }

    /*
     * 拒绝提现
     */

    function actionRefuse($id) {
        $txinfo_model = Txinfo::model();
        $txinfo_info = $txinfo_model->findByPk($id);
        if (isset($_POST['Txinfo'])) {
            foreach ($_POST['Txinfo'] as $_k => $_v) {
                $txinfo_info->$_k = strip_tags($_v);
            }
            $txinfo_info->txnum = $txinfo_info["txnum"] - 1;
            $title = "提现申请被拒绝";
            $content = $title . "原因：" . $txinfo_info["remark"] . "，返还" . ($txinfo_info["applymoney"] * 10000) . "元宝";
            $hlb_model = $this->updhlb($txinfo_info["applymoney"] * 10000, 7, $content, $txinfo_info["mem_id"], 0);
            $this->sendmessage($title, $content, 1, $txinfo_info["mem_id"]);
            $txinfo_info->starts = "已拒绝";
            $txinfo_info->thlb_id = $hlb_model["id"];
            $txinfo_info->cl_time = date("Y-m-d H:i:s", time());
            if ($txinfo_info->update()) {
                Yii::app()->user->setFlash('msg', '拒绝提现成功！');
                $result = "success";
            }
        }
        $this->renderPartial('refuse', array('txinfo_model' => $txinfo_info, 'result' => $result));
    }

    /*
     * 同意提现
     */

    function actionAgree($id) {
        $txinfo_model = Txinfo::model();
        $txinfo_info = $txinfo_model->findByPk($id);
        $txinfo_info->starts = "已支付";
        $txinfo_info->cl_time = date("Y-m-d H:i:s", time());
        if ($txinfo_info->update()) {
            $memid = $txinfo_info["mem_id"];
            $mem_info = Mem::model()->findByPk($memid);
            //获取提现金额
            $tx_money = Tx::model()->countBySql("select sum(money) from {{tx}} where mem_id=" . $mem_info['id'] . " and  starts='已支付' ");
            //上级会员奖励
            if ($tx_money < 10) {
                if (empty($mem_info["tx_rewards_gs"])) {
                    $this->rewards($mem_info, 1, "首次"); //1表示执行首次提现公式
                    $mem_info->tx_rewards_gs = 1; //表示提现奖励被执行公式
                }
            } else if ($tx_money >= 10 && $tx_money < 30) {
                if (empty($mem_info["tx_rewards_gs"]) || $mem_info["tx_rewards_gs"] == 1) {//表示没有执行任何体现奖励公式
                    $this->rewards($mem_info, 2, "满10元"); //2表示执行 首次提现公式和满10元公式
                    $mem_info->tx_rewards_gs = 2; //表示提现奖励被执行公式
                }
            } else if ($tx_money >= 30 && $tx_money < 50) {
                if (empty($mem_info["tx_rewards_gs"]) || $mem_info["tx_rewards_gs"] == 1 || $mem_info["tx_rewards_gs"] == 2) {//表示没有执行任何体现奖励公式
                    $this->rewards($mem_info, 3, "满30元");
                    $mem_info->tx_rewards_gs = 3; //表示提现奖励被执行公式
                }
            } else if ($tx_money >= 50 && $tx_money < 100) {
                if (empty($mem_info["tx_rewards_gs"]) || $mem_info["tx_rewards_gs"] == 1 || $mem_info["tx_rewards_gs"] == 2 || $mem_info["tx_rewards_gs"] == 3) {//表示没有执行任何体现奖励公式
                    $this->rewards($mem_info, 4, "满50元");
                    $mem_info->tx_rewards_gs = 4; //表示提现奖励被执行公式
                }
            } else if ($tx_money >= 100) {
                if (empty($mem_info["tx_rewards_gs"]) || $mem_info["tx_rewards_gs"] == 1 || $mem_info["tx_rewards_gs"] == 2 || $mem_info["tx_rewards_gs"] == 3 || $mem_info["tx_rewards_gs"] == 4) {//表示没有执行任何体现奖励公式
                    $this->rewards($mem_info, 5, "满100元");
                    $mem_info->tx_rewards_gs = 5; //表示提现奖励被执行公式
                }
            }
            $this->sendmessage("成功提现", "成功提现" . $txinfo_info["applymoney"]."元", 1, $memid);
            $mem_info->update();
            Yii::app()->user->setFlash('msg', '已同意提现');
            $this->redirect("../../show");
        }
    }

    //上级会员奖励
    function rewards($mem_info, $id, $reason) {
        $system_info = System::model()->findByPk(1);
        if (!empty($mem_info["pid"])) {
            $array = explode(",", $mem_info["pid"]);
            $n = count($array);
            $j = 1;
            $title = "您邀请的" . $mem_info["mem_name"] . "会员,提现" . $reason . "所得奖励！";
            $content = "好友邀请：" . $title;
            for ($i = ($n - 2); $i >= 0; $i--) {
                if ($j == 1 || $j == 2 || $j == 3 || $j == 4) {
                    if (!empty($mem_info["role"])) {
                        if ($j == 1) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx1'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx1'] + $system_info['zz10tx1'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx1'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx1'] + $system_info['zz10tx1'] + $system_info['zz30tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx1'] + $system_info['zz30tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx1'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx1'] + $system_info['zz10tx1'] + $system_info['zz30tx1'] + $system_info['zz50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx1'] + $system_info['zz30tx1'] + $system_info['zz50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx1'] + $system_info['zz50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx1'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx1'] + $system_info['zz10tx1'] + $system_info['zz30tx1'] + $system_info['zz50tx1'] + $system_info['zz100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx1'] + $system_info['zz30tx1'] + $system_info['zz50tx1'] + $system_info['zz100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx1'] + $system_info['zz50tx1'] + $system_info['zz100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx1'] + $system_info['zz100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['zz100tx1'];
                                }
                            }
                        } else if ($j == 2) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx2'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx2'] + $system_info['zz10tx2'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx2'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx2'] + $system_info['zz10tx2'] + $system_info['zz30tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx2'] + $system_info['zz30tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx2'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx2'] + $system_info['zz10tx2'] + $system_info['zz30tx2'] + $system_info['zz50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx2'] + $system_info['zz30tx2'] + $system_info['zz50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx2'] + $system_info['zz50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx2'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx2'] + $system_info['zz10tx2'] + $system_info['zz30tx2'] + $system_info['zz50tx2'] + $system_info['zz100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx2'] + $system_info['zz30tx2'] + $system_info['zz50tx2'] + $system_info['zz100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx2'] + $system_info['zz50tx2'] + $system_info['zz100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx2'] + $system_info['zz100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['zz100tx2'];
                                }
                            }
                        } else if ($j == 3) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx3'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx3'] + $system_info['zz10tx3'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx3'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx3'] + $system_info['zz10tx3'] + $system_info['zz30tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx3'] + $system_info['zz30tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx3'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx3'] + $system_info['zz10tx3'] + $system_info['zz30tx3'] + $system_info['zz50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx3'] + $system_info['zz30tx3'] + $system_info['zz50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx3'] + $system_info['zz50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx3'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx3'] + $system_info['zz10tx3'] + $system_info['zz30tx3'] + $system_info['zz50tx3'] + $system_info['zz100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx3'] + $system_info['zz30tx3'] + $system_info['zz50tx3'] + $system_info['zz100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx3'] + $system_info['zz50tx3'] + $system_info['zz100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx3'] + $system_info['zz100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['zz100tx3'];
                                }
                            }
                        } else if ($j == 4) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx4'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx4'] + $system_info['zz10tx4'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx4'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx4'] + $system_info['zz10tx4'] + $system_info['zz30tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx4'] + $system_info['zz30tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx4'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx4'] + $system_info['zz10tx4'] + $system_info['zz30tx4'] + $system_info['zz50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx4'] + $system_info['zz30tx4'] + $system_info['zz50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx4'] + $system_info['zz50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx4'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['zztx4'] + $system_info['zz10tx4'] + $system_info['zz30tx4'] + $system_info['zz50tx4'] + $system_info['zz100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['zz10tx4'] + $system_info['zz30tx4'] + $system_info['zz50tx4'] + $system_info['zz100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['zz30tx4'] + $system_info['zz50tx4'] + $system_info['zz100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['zz50tx4'] + $system_info['zz100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['zz100tx4'];
                                }
                            }
                        }
                    } else {
                        if ($j == 1) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx1'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx1'] + $system_info['10tx1'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx1'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx1'] + $system_info['10tx1'] + $system_info['30tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx1'] + $system_info['30tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx1'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx1'] + $system_info['10tx1'] + $system_info['30tx1'] + $system_info['50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx1'] + $system_info['30tx1'] + $system_info['50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx1'] + $system_info['50tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx1'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx1'] + $system_info['10tx1'] + $system_info['30tx1'] + $system_info['50tx1'] + $system_info['100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx1'] + $system_info['30tx1'] + $system_info['50tx1'] + $system_info['100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx1'] + $system_info['50tx1'] + $system_info['100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx1'] + $system_info['100tx1'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['100tx1'];
                                }
                            }
                        } else if ($j == 2) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx2'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx2'] + $system_info['10tx2'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx2'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx2'] + $system_info['10tx2'] + $system_info['30tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx2'] + $system_info['30tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx2'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx2'] + $system_info['10tx2'] + $system_info['30tx2'] + $system_info['50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx2'] + $system_info['30tx2'] + $system_info['50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx2'] + $system_info['50tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx2'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx2'] + $system_info['10tx2'] + $system_info['30tx2'] + $system_info['50tx2'] + $system_info['100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx2'] + $system_info['30tx2'] + $system_info['50tx2'] + $system_info['100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx2'] + $system_info['50tx2'] + $system_info['100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx2'] + $system_info['100tx2'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['100tx2'];
                                }
                            }
                        } else if ($j == 3) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx3'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx3'] + $system_info['10tx3'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx3'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx3'] + $system_info['10tx3'] + $system_info['30tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx3'] + $system_info['30tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx3'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx3'] + $system_info['10tx3'] + $system_info['30tx3'] + $system_info['50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx3'] + $system_info['30tx3'] + $system_info['50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx3'] + $system_info['50tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx3'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx3'] + $system_info['10tx3'] + $system_info['30tx3'] + $system_info['50tx3'] + $system_info['100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx3'] + $system_info['30tx3'] + $system_info['50tx3'] + $system_info['100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx3'] + $system_info['50tx3'] + $system_info['100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx3'] + $system_info['100tx3'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['100tx3'];
                                }
                            }
                        } else if ($j == 4) {
                            if ($id == 1) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx4'];
                                }
                            } else if ($id == 2) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx4'] + $system_info['10tx4'];
                                } elseif ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx4'];
                                }
                            } else if ($id == 3) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx4'] + $system_info['10tx4'] + $system_info['30tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx4'] + $system_info['30tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx4'];
                                }
                            } else if ($id == 4) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx4'] + $system_info['10tx4'] + $system_info['30tx4'] + $system_info['50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx4'] + $system_info['30tx4'] + $system_info['50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx4'] + $system_info['50tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx4'];
                                }
                            } else if ($id == 5) {
                                if (empty($mem_info["tx_rewards_gs"])) {//表示没有执行任何体现奖励公式
                                    $hlb = $system_info['tx4'] + $system_info['10tx4'] + $system_info['30tx4'] + $system_info['50tx4'] + $system_info['100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 1) {
                                    $hlb = $system_info['10tx4'] + $system_info['30tx4'] + $system_info['50tx4'] + $system_info['100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 2) {
                                    $hlb = $system_info['30tx4'] + $system_info['50tx4'] + $system_info['100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 3) {
                                    $hlb = $system_info['50tx4'] + $system_info['100tx4'];
                                } else if ($mem_info["tx_rewards_gs"] == 4) {
                                    $hlb = $system_info['100tx4'];
                                }
                            }
                        }
                    }

                    $this->updhlb($hlb, 7, $content, $array[$i], $mem_info["id"]);
                    $this->sendmessage($title, $content, 1, $array[$i]);
                }
                $j++;
            }
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $txinfo_model = Txinfo::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $txinfo_info = $txinfo_model->findByPk($id);
            if ($txinfo_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
