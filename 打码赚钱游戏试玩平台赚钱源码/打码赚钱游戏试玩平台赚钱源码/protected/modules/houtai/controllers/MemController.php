<?php

/*
 * 会员管理
 */

class MemController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是Administrator的用户
                'actions' => array('off', "on", 'show', 'edit', 'alldel', "updhlb", "dethlb", "detail"),
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
        $sql = "SELECT * FROM {{mem}} where 1=1 ";
        $sb = '';
        $memid = null;
        if (isset($_GET['memid']) || isset($_POST['memid'])) {
            if (!empty($_POST['memid'])) {
                $memid = $_POST['memid'];
            } else if (!empty($_GET['memid'])) {
                $memid = $_GET['memid'];
            }
            $sb = $sb . " and id like '%" . $memid . "%' ";
        }
        $email = null;
        if (isset($_GET['email']) || isset($_POST['email'])) {
            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
            } else if (!empty($_GET['email'])) {
                $email = $_GET['email'];
            }
            $sb = $sb . " and email like '%" . $email . "%' ";
        }
        $memname = null;
        if (isset($_GET['memname']) || isset($_POST['memname'])) {
            if (!empty($_POST['memname'])) {
                $memname = $_POST['memname'];
            } else if (!empty($_GET['memname'])) {
                $memname = $_GET['memname'];
            }
            $sb = $sb . " and mem_name like '%" . $memname . "%' ";
        }
        
        $idcode = null;
        if (isset($_GET['idcode']) || isset($_POST['idcode'])) {
            if (!empty($_POST['idcode'])) {
                $idcode = $_POST['idcode'];
            } else if (!empty($_GET['idcode'])) {
                $idcode = $_GET['idcode'];
            }
            $sb = $sb . " and idcode like '%" . $idcode . "%' ";
        }
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 5;
        $pages->params = array('email' => $email, "memid" => $memid, "memname" => $memname,"idcode"=>$idcode);
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
        $pages->pageSize = 20;
        $pages->params = array('start' => $start, 'end' => $end, "memid" => $memid);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('detail', array('posts' => $posts, 'pages' => $pages, "memid" => $memid));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $meminfo_model = Meminfo::model();
        $meminfo_info = $meminfo_model->findByPk($id);
        $alipay_model = Alipay::model();
        $alipay_info = $alipay_model->findBySql("select * from {{alipay}} where mem_id=" . $id);
        $treasure_model = Treasure::model();
        $treasure_info = $treasure_model->findBySql("select * from {{treasure}} where mem_id=" . $id);
        $bank_model = Bank::model();
        $bank_info = $bank_model->findBySql("select * from {{bank}} where mem_id=" . $id);
        if (isset($_POST['Meminfo'])) {
            $mempwd = $meminfo_info["pwd"];
            foreach ($_POST['Meminfo'] as $_k => $_v) {
                $meminfo_info->$_k = strip_tags($_v);
            }
            if ($mempwd != $meminfo_info["pwd"]) {
                $meminfo_info->pwd = md5($meminfo_info["pwd"] . "wp");
            }
            if (!empty($_POST['alipay_name']) || !empty($_POST['alipay_account'])) {
                $alipay_info->name = $_POST['alipay_name'];
                $alipay_info->account = $_POST['alipay_account'];
                $alipay_info->update();
            }

            if (!empty($_POST['treasure_name']) || !empty($_POST['treasure_account'])) {
                $treasure_info->name = $_POST['treasure_name'];
                $treasure_info->account = $_POST['treasure_account'];
                $treasure_info->update();
            }
            if (!empty($_POST['bank_bank']) || !empty($_POST['bank_banksub']) || !empty($_POST['bank_name']) || !empty($_POST['bank_account'])) {
                $bank_info->bank = $_POST['bank_banksub'];
                $bank_info->banksub = $_POST['bank_name'];
                $bank_info->name = $_POST['bank_bank'];
                $bank_info->account = $_POST['bank_account'];
                $bank_info->update();
            }
            if ($meminfo_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('mem_model' => $meminfo_info, 'alipay_info' => $alipay_info, "treasure_info" => $treasure_info, "bank_info" => $bank_info, 'result' => $result));
    }

    /*
     * 操作元宝
     */

    function actionUpdhlb($id) {
        $hlb_model = new Hlb();
        $hlbnum = $hlb_model->countBySql("select sum(hlb) from {{hlb}} where mem_id=" . $id);
        if (isset($_POST['Hlb'])) {
            foreach ($_POST['Hlb'] as $_k => $_v) {
                $hlb_model->$_k = strip_tags($_v);
            }
            $title = "管理员操作元宝!";
            if ($hlb_model["type"] == 2) {
                $hlb_model->hlb = -$hlb_model["hlb"]; //扣除元宝    
                $hlb_model->type = 2;
                $content = $title . $_POST["remark"] . "减少" . $hlb_model["hlb"] . "元宝！";
            } else {
                $hlb_model->type = 1; //增加元宝
                $content = $title . $_POST["remark"] . "增加" . $hlb_model["hlb"] . "元宝！";
            }
            $hlb_model->source = 15; //消耗元宝来源--提现
            $hlb_model->reason = $content; //元宝更改原因
            $hlb_model->mem_id = $id;
            $hlb_model->pmem_id = 0;
            if ($hlb_model->save()) {
                if ($hlb_model["type"] == 1) {
                    Yii::app()->user->setFlash('msg', '增加元宝成功！');
                } else {
                    Yii::app()->user->setFlash('msg', '扣除元宝成功！');
                }
                $this->sendmessage($title, $content, 1, $id);
                $result = "success";
            }
        }
        $this->renderPartial('hlb', array('hlb_model' => $hlb_model, "hlbnum" => $hlbnum, 'result' => $result));
    }

    /*
     * 元宝详细
     */

    function actionDethlb($id) {
        $sql = "SELECT * FROM {{hlb}} where 1=1 and mem_id=" . $id;
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
        $pages->pageSize = 10;

        $pages->params = array('start' => $start, 'end' => $end, "id" => $id);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('dethlb', array('posts' => $posts, 'pages' => $pages, "id" => $id), "", $processOutput = TRUE);
    }

    /*
     * 禁用
     */

    function actionOff($id) {
        $mem_model = Mem::model();
        $mem_info = $mem_model->findByPk($id);
        $mem_info->valid = 1;
        if ($mem_info->update()) {
            Yii::app()->user->setFlash('msg', '禁用成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 启用
     */

    function actionOn($id) {
        $mem_model = Mem::model();
        $mem_info = $mem_model->findByPk($id);
        $mem_info->valid = 0;
        if ($mem_info->update()) {
            Yii::app()->user->setFlash('msg', '启用成功');
            $this->redirect("../../show");
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $mem_model = Mem::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $mem_info = $mem_model->findByPk($id);
            if ($mem_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
