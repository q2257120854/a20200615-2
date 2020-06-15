<?php

//提现管理
class VipadvanceController extends Controllervip {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('txalipay', 'txbank', 'txtreasure', 'ticket', 'detail', 'alipay', 'bank', 'treasure', 'note', 'editalipay', 'editbank', 'edittreasure', 'data'),
                'expression' => 'Yii::app()->user->isLogin()',
            ),
            array(
                'deny', //禁止
                'users' => array('*'), //*所有用户
            ),
        );
    }

    /*
     * 支付宝提现 -元宝
     */

    function actionTxalipay() {
        $mem = $this->show_mem();
        $alipay_info = Alipay::model()->findByPk($mem['alipayid']);
        $count = Tx::model()->countBySql("select count(*) from {{tx}} where mem_id=" . $mem["id"] . " and starts='待支付'");
        if (empty($count)) {
            $tx_model = new Tx();
            if (isset($_POST['Tx'])) {
                foreach ($_POST['Tx'] as $_k => $_v) {
                    $tx_model->$_k = strip_tags($_v);
                }
                $tx_model->way = "支付宝";
                $memid = $mem["id"];
                $system_info = System::model()->findByPk(1);
                $tx_info = Tx::model()->findBySql("select txnum from {{tx}} where mem_id=" . $memid . "  ORDER BY create_time desc  limit 1");
                if (!empty($tx_info["txnum"])) {
                    if ($tx_model['applymoney'] < $system_info['money']) {
                        $tx_model['fee'] = $system_info['fee'];
                    } else {
                        $tx_model['fee'] = 0;
                    }
                    $tx_model['txnum'] = $tx_info['txnum'] + 1;
                } else {
                    //为首次提现
                    $tx_model['txnum'] = 1;
                    $tx_model['fee'] = 0;
                }
                //申请金额在金额区间内获得奖励
                if ($tx_model['applymoney'] >= 100 && $tx_model['applymoney'] < 300) {
                    $tx_model['rewards'] = $system_info['cash_rewards1'];
                } else if ($tx_model['applymoney'] >= 300 && $tx_model['applymoney'] < 600) {
                    $tx_model['rewards'] = $system_info['cash_rewards2'];
                } else if ($tx_model['applymoney'] >= 600 && $tx_model['applymoney'] < 800) {
                    $tx_model['rewards'] = $system_info['cash_rewards3'];
                } else if ($tx_model['applymoney'] >= 800 && $tx_model['applymoney'] < 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards4'];
                } else if ($tx_model['applymoney'] >= 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards5'];
                } else {
                    $tx_model['rewards'] = 0;
                }
                $tx_model['money'] = $tx_model['applymoney'] - $tx_model['fee'] + $tx_model['rewards'];
                $tx_model['starts'] = "待支付";
                if ($tx_model->save()) {
                    $hlb = ($tx_model['applymoney'] * $system_info['hlb_exchange_money']);
                    $title = "您申请提现" . $tx_model['applymoney'] . "元";
                    $reason = $title . "，扣除" . $hlb . "元宝";
                    $hlb_model = $this->updhlb(-$hlb, 7, $reason, $memid, 0); //扣除元宝
                    $this->sendmessage($title, $reason, 1, $memid); //1为系统消息
                    $tx_model->hlb_id = $hlb_model['id'];
                    $tx_model->update();
                    Yii::app()->user->setFlash('msg', 'success');
                }
            }
        }
        $this->renderPartial('txalipay', array('tx_model' => $tx_model, "alipay_info" => $alipay_info));
    }

    /*
     * 财付通提现 -元宝
     */

    function actionTxtreasure() {
        $mem = $this->show_mem();
        $tresure_info = Treasure::model()->findByPk($mem['treasureid']);
        $count = Tx::model()->countBySql("select count(*) from {{tx}} where mem_id=" . $mem["id"] . " and starts='待支付'");
        if (empty($count)) {
            $tx_model = new Tx();
            if (isset($_POST['Tx'])) {
                foreach ($_POST['Tx'] as $_k => $_v) {
                    $tx_model->$_k = strip_tags($_v);
                }
                $tx_model->way = "财付通";
                $memid = $mem["id"];
                $system_info = System::model()->findByPk(1);
                $tx_info = Tx::model()->countBySql("select txnum from {{tx}} where mem_id=" . $memid);
                if (!empty($tx_info)) {
                    if ($tx_model['applymoney'] < $system_info['money']) {
                        $tx_model['fee'] = $system_info['fee'];
                    } else {
                        $tx_model['fee'] = 0;
                    }
                    $tx_model['txnum'] = $tx_info['txnum'] + 1;
                } else {
                    //为首次提现
                    $tx_model['txnum'] = 1;
                    $tx_model['fee'] = 0;
                }
                //申请金额在金额区间内获得奖励
                if ($tx_model['applymoney'] >= 100 && $tx_model['applymoney'] < 300) {
                    $tx_model['rewards'] = $system_info['cash_rewards1'];
                } else if ($tx_model['applymoney'] >= 300 && $tx_model['applymoney'] < 600) {
                    $tx_model['rewards'] = $system_info['cash_rewards2'];
                } else if ($tx_model['applymoney'] >= 600 && $tx_model['applymoney'] < 800) {
                    $tx_model['rewards'] = $system_info['cash_rewards3'];
                } else if ($tx_model['applymoney'] >= 800 && $tx_model['applymoney'] < 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards4'];
                } else if ($tx_model['applymoney'] >= 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards5'];
                } else {
                    $tx_model['rewards'] = 0;
                }
                $tx_model['money'] = $tx_model['applymoney'] - $tx_model['fee'] + $tx_model['rewards'];
                $tx_model['starts'] = "待支付";


                if ($tx_model->save()) {
                    $hlb = ($tx_model['applymoney'] * $system_info['hlb_exchange_money']);
                    $title = "您申请提现" . $tx_model['applymoney'] . "元";
                    $reason = $title . "，扣除" . $hlb . "元宝";
                    $hlb_model = $this->updhlb(-$hlb, 7, $reason, $memid, 0); //扣除元宝
                    $this->sendmessage($title, $reason, 1, $memid); //1为系统消息
                    $tx_model->hlb_id = $hlb_model['id'];
                    $tx_model->update();
                    Yii::app()->user->setFlash('msg', 'success');
                }
            }
        }
        $this->renderPartial('txtreasure', array('tx_model' => $tx_model, "tresure_info" => $tresure_info));
    }

    /*
     * 银行卡提现 -元宝
     */

    function actionTxbank() {
        $mem = $this->show_mem();
        $bank_info = Bank::model()->findByPk($mem['bankid']);
        $count = Tx::model()->countBySql("select count(*) from {{tx}} where mem_id=" . $mem["id"] . " and starts='待支付'");
        if (empty($count)) {
            $tx_model = new Tx();
            if (isset($_POST['Tx'])) {
                foreach ($_POST['Tx'] as $_k => $_v) {
                    $tx_model->$_k = strip_tags($_v);
                }
                $tx_model->way = "银行卡";
                $memid = $mem["id"];
                $system_info = System::model()->findByPk(1);
                $tx_info = Tx::model()->countBySql("select txnum from {{tx}} where mem_id=" . $memid);
                if (!empty($tx_info)) {
                    if ($tx_model['applymoney'] < $system_info['money']) {
                        $tx_model['fee'] = $system_info['fee'];
                    } else {
                        $tx_model['fee'] = 0;
                    }
                    $tx_model['txnum'] = $tx_info['txnum'] + 1;
                } else {
                    //为首次提现
                    $tx_model['txnum'] = 1;
                    $tx_model['fee'] = 0;
                }
                //申请金额在金额区间内获得奖励
                if ($tx_model['applymoney'] >= 100 && $tx_model['applymoney'] < 300) {
                    $tx_model['rewards'] = $system_info['cash_rewards1'];
                } else if ($tx_model['applymoney'] >= 300 && $tx_model['applymoney'] < 600) {
                    $tx_model['rewards'] = $system_info['cash_rewards2'];
                } else if ($tx_model['applymoney'] >= 600 && $tx_model['applymoney'] < 800) {
                    $tx_model['rewards'] = $system_info['cash_rewards3'];
                } else if ($tx_model['applymoney'] >= 800 && $tx_model['applymoney'] < 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards4'];
                } else if ($tx_model['applymoney'] >= 1000) {
                    $tx_model['rewards'] = $system_info['cash_rewards5'];
                } else {
                    $tx_model['rewards'] = 0;
                }
                $tx_model['money'] = $tx_model['applymoney'] - $tx_model['fee'] + $tx_model['rewards'];
                $tx_model['starts'] = "待支付";
                if ($tx_model->save()) {
                    $hlb = ($tx_model['applymoney'] * $system_info['hlb_exchange_money']);
                    $title = "您申请提现" . $tx_model['applymoney'] . "元";
                    $reason = $title . "，扣除" . $hlb . "元宝";
                    $hlb_model = $this->updhlb(-$hlb, 7, $reason, $memid, 0); //扣除元宝
                    $this->sendmessage($title, $reason, 1, $memid); //1为系统消息
                    $tx_model->hlb_id = $hlb_model['id'];
                    $tx_model->update();
                    Yii::app()->user->setFlash('msg', 'success');
                }
            }
        }
        $this->renderPartial('txbank', array('tx_model' => $tx_model, "bank_info" => $bank_info));
    }

    /*
     * 申请提现 -金券
     */

    function actionTicket() {

        $this->renderPartial('ticket');
    }

    /*
     * 提现明细
     */

    function actionDetail() {
        $mem = $this->show_mem();
        $id = 1;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }
        $sql = "SELECT * FROM {{tx}} where mem_id=" . $mem['id'];
        $sql = $sql . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('id' => $id);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->renderPartial('detail', array('posts' => $posts, 'pages' => $pages, 'id' => $id), "", $processOutput = TRUE);
    }

    /*
     * 支付宝
     */

    function actionAlipay() {
        $alipay_model = new Alipay();
        if (isset($_POST['Alipay'])) {
            foreach ($_POST['Alipay'] as $_k => $_v) {
                $alipay_model->$_k = strip_tags($_v);
            }
            if ($alipay_model->save()) {
                $mem = $this->show_mem();
                $mem_info = Mem::model()->findByPk($mem["id"]);
                $mem_info->alipayid = $alipay_model['id'];
                $mem_info->update();
                Yii::app()->user->setFlash('msg', '绑定成功');
            }
        }
        $this->renderPartial('alipay', array("alipay_model" => $alipay_model));
    }

    /*
     * 修改支付宝
     */

    function actionEditalipay($id) {
        $alipay_model = Alipay::model();
        $alipay_info = $alipay_model->findByPk($id);
        if (isset($_POST['Alipay'])) {
            foreach ($_POST['Alipay'] as $_k => $_v) {
                $alipay_info->$_k = strip_tags($_v);
            }
            if ($alipay_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
            }
        }
        $this->renderPartial('alipay', array("alipay_model" => $alipay_info));
    }

    /*
     * 财付通
     */

    function actionTreasure() {
        $treasure_model = new Treasure();
        if (isset($_POST['Treasure'])) {
            foreach ($_POST['Treasure'] as $_k => $_v) {
                $treasure_model->$_k = strip_tags($_v);
            }
            if ($treasure_model->save()) {
                $mem = $this->show_mem();
                $mem_info = Mem::model()->findByPk($mem["id"]);
                $mem_info['treasureid'] = $treasure_model['id'];
                $mem_info->update();
                Yii::app()->user->setFlash('msg', '绑定成功');
            }
        }
        $this->renderPartial('treasure', array("treasure_model" => $treasure_model));
    }

    /*
     * 修改财付通
     */

    function actionEdittreasure($id) {
        $treasure_model = Treasure::model();
        $treasure_info = $treasure_model->findByPk($id);
        if (isset($_POST['Treasure'])) {
            foreach ($_POST['Treasure'] as $_k => $_v) {
                $treasure_info->$_k = strip_tags($_v);
            }
            if ($treasure_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
            }
        }
        $this->renderPartial('treasure', array("treasure_model" => $treasure_info));
    }

    /*
     * 银行
     */

    function actionBank() {
        $bank_model = new Bank();
        if (isset($_POST['Bank'])) {
            foreach ($_POST['Bank'] as $_k => $_v) {
                $bank_model->$_k = strip_tags($_v);
            }
            if ($bank_model->save()) {
                $mem = $this->show_mem();
                $mem_info = Mem::model()->findByPk($mem["id"]);
                $mem_info['bankid'] = $bank_model['id'];
                $mem_info->update();
                Yii::app()->user->setFlash('msg', '绑定成功');
            }
        }
        $this->renderPartial('bank', array("bank_model" => $bank_model));
    }

    /*
     * 修改银行
     */

    function actionEditbank($id) {
        $bank_model = Bank::model();
        $bank_info = $bank_model->findByPk($id);
        if (isset($_POST['Bank'])) {
            foreach ($_POST['Bank'] as $_k => $_v) {
                $bank_info->$_k = strip_tags($_v);
            }
            if ($bank_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
            }
        }
        $this->renderPartial('bank', array("bank_model" => $bank_info));
    }

}
