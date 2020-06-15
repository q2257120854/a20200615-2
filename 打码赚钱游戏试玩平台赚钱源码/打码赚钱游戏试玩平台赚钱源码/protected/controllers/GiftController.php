<?php

/*
 * 兑换商城
 */

class GiftController extends Controller {
    /*
     * 首页展示
     */

    function actionShow() {

        $this->renderPartial('show');
    }

    /*
     * 所有奖品
     */

    function actionList() {
        $gift_model = Gift::model();
        $gift_info = $gift_model->findAllBySql("select * from {{gift}} where valid =0 order by id desc");
        $this->renderPartial('list', array('gift_info' => $gift_info));
    }

    /*
     * 根据条件列出的奖品
     */

    function actionByList($hld) {
        $gift_model = Gift::model();
        $gift_info = $gift_model->findAllBySql("select * from {{gift}} where hld_num <=" . $hld . " order by id desc");
        $this->renderPartial('bylist', array('gift_info' => $gift_info));
    }

    /*
     * 类型奖品
     */

    function actionType($id) {
        $gifttype_model = Gifttype::model();
        $gift_model = Gift::model();
        if (!empty($id)) {
            $gifttype_info = $gifttype_model->findAllBySql("select * from {{gift_type}} where pid =" . $id);
            $ids = "";
            foreach ($gifttype_info as $info) {
                $ids = $ids . $info['id'] . ',';
            }
            $ids = $ids . $id;
            $gift_info = $gift_model->findAllBySql("select id,img,name,hld_num,exchange_num from {{gift}} where gift_type_id in (" . $ids . ")");
            $this->renderPartial('type', array('gift_info' => $gift_info, 'id' => $id));
        }
    }

    /*
     * 详细
     */

    function actionDetail($id) {
        if (!empty($id)) {
            $gift_model = Gift::model();
            $gift_info = $gift_model->findByPk($id);
        }
        $this->renderPartial('detail', array('gift_info' => $gift_info));
    }

    /*
     * 立即兑换
     */

    function actionExchange($id) {
        $addressid = $_POST["addressid"];
        $giftid = $id;
        $address_model = new Address();
        $gift_model = Gift::model();
        $gift_info = $gift_model->findByPk($id);
        $mem = $this->show_mem();
        $memid = $mem['id'];
        if (empty($addressid)) {  //获取新地址
            if (isset($_POST['Address'])) {
                foreach ($_POST['Address'] as $_k => $_v) {
                    $address_model->$_k = strip_tags($_v);
                }
                if ($address_model->save()) {
                    $addressid = $address_model["id"];
                }
            }
        }
        if (!empty($addressid)) {
            $hld = Hld::model()->countBySql("select sum(hld) from {{hld}} where  mem_id=" . $memid);
            if ($hld >= $gift_info['hld_num']) {
                $title = "兑换" . $gift_info['name'];
                $hld = -$gift_info['hld_num'];
                $content = $title . ",消耗金豆" . $gift_info['hld_num'];
                $hld_model = $this->updhld($hld, 1, $content, $memid);
                if (!empty($hld)) {
                    $this->sendmessage($title, $content, 1, $memid);
                }
                $address_info = Address::model()->findByPk($addressid);
                $giftdh = new Giftdh();
                $giftdh->hld = $gift_info['hld_num'];
                $giftdh->hld_id = $hld_model['id'];
                $giftdh->gift_id = $giftid;
                $giftdh->name = $gift_info['name'];
                $giftdh->starts = "兑换中";
                $giftdh->consignee = $address_info['name'];
                $giftdh->province = $address_info['province'];
                $giftdh->city = $address_info['city'];
                $giftdh->district = $address_info['district'];
                $giftdh->address = $address_info['address'];
                $giftdh->memqq = $address_info['memqq'];
                $giftdh->remark = $address_info['remark'];
                $giftdh->phone = $address_info['phone'];
                $giftdh->tel = $address_info['tel'];
                $giftdh->mem_id = $address_info['mem_id'];
                $giftdh->mem_name = $mem["mem_name"];
                if ($giftdh->save()) {
                    $gift_info->exchange_num = $gift_info["exchange_num"] + 1;
                    $gift_info->update();
                    Yii::app()->user->setFlash('msg', 'success');
                }
            } else {
                Yii::app()->user->setFlash('msg', 'error');
            }
        } else {
            $name = $address_model->getError("name");
            $province = $address_model->getError("province");
            $phone = $address_model->getError("phone");
            $memqq = $address_model->getError("memqq");
        }
        $this->renderPartial('exchange', array('gift_info' => $gift_info, "address_model" => $address_model, "name" => $name, "province" => $province, "phone" => $phone, "memqq" => $memqq, "addressid" => $addressid), '', $processOutput = TRUE);
    }

}
