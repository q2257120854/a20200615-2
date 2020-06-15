<?php

/*
 * 站长联盟
 */

class WebController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'edit', 'refuse', 'agree', "rank", "wage"),
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
        $sql = "SELECT * FROM {{web}} where 1=1";
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
        $sql = $sql . $sb . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        $pages->params = array('name' => $name);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }
    
    

    //更新邀请排名
    function actionRank() {
        $hlb_model = Hlb::model();
        $num = $hlb_model->countBySql(" select count(*) from {{hlb}}  where  date_format(create_time,'%Y-%m') between date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m')  and date_format(DATE_SUB(curdate(), INTERVAL -2 MONTH),'%Y-%m')  and reason like '%邀请排行%'  ");  //0表示没有更新
        if (empty($num)) {
            //$sql = "select mem_id  from {{hlb}} WHERE date_format(create_time,'%Y-%m') between date_format(DATE_SUB(curdate(), INTERVAL 2 MONTH),'%Y-%m')  and date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m')  and pmem_id !=0  GROUP BY mem_id  ORDER BY SUM(hlb) DESC   limit " . intval($count);
            $rank_model = Rank::model();
            $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=5  and start='已开启' order by grade ");
            if (date("Y-m") == "2015-07") {
                $sql = "select mem_id  from {{hlb}} WHERE  pmem_id !=0 and create_time  between  '2015-05-01 00:00' and '2015-06-30 23:59' GROUP BY mem_id  ORDER BY SUM(hlb) DESC  ";
            } else {
                $sql = "select mem_id  from {{hlb}} WHERE  pmem_id !=0 and date_format(create_time,'%Y-%m') between date_format(DATE_SUB(curdate(), INTERVAL 0 MONTH),'%Y-%m')  and date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m') GROUP BY mem_id  ORDER BY SUM(hlb) DESC ";
            }
            foreach ($rank_info as $index => $rankinfo) {
                $num = $index + 1;
                $hlb_info = $hlb_model->findBySql($sql . " limit " . $index . ",1");
                $title = "邀请排行更新!";
                $content = $title . "排名第" . $num . "名,获得元宝 :" . $rankinfo["rewards_hlb"];
                $this->updhlb($rankinfo["rewards_hlb"], 1, $content, $hlb_info["mem_id"], 0);
                $this->sendmessage($title, $content, 1, $hlb_info["mem_id"]);
            }
            Yii::app()->user->setFlash('msg', '前两个月邀请排行更新成功');
        } else {
            Yii::app()->user->setFlash('msg', '前两个月邀请排行已经更新了');
        }
        $this->redirect("show");
    }
    
    

    //更新推广工资
    function actionWage() {
        $hlb_model = Hlb::model();
        $num = $hlb_model->countBySql("select * from {{hlb}}  where date_format(create_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m')  and reason like '%推广工资%' ");  //0表示没有更新
        if (empty($num)) {
            // $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  date_format(create_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL 1 MONTH),'%Y-%m') and pmem_id !=0  GROUP BY mem_id  ORDER BY SUM(hlb) DESC ";
            if (date("Y-m") == "2015-07") {
                $sql = "select mem_id , SUM(hlb) as hlbnum from {{hlb}} WHERE  pmem_id !=0 and create_time  between  '2015-05-01 00:00' and '2015-06-30 23:59' GROUP BY mem_id  ORDER BY SUM(hlb) DESC  ";
            } else {
                $sql = "select mem_id  from {{hlb}} WHERE  pmem_id !=0 and date_format(create_time,'%Y-%m')=date_format(DATE_SUB(curdate(), INTERVAL -1 MONTH),'%Y-%m') GROUP BY mem_id  ORDER BY SUM(hlb) DESC ";
            }

            $hlb_info = $hlb_model->findAllBySql($sql);
            $system_info = System::model()->findByPk(1);
            foreach ($hlb_info as $hlbinfo) {
                $hlb = $hlbinfo["hlbnum"] / 10000;
                $flag = FALSE;
                if ($hlb >= 5000) {
                    $rewardshlb = intval(($system_info["wage5"] / 100) * 50000000);
                    $flag = TRUE;
                } else if ($hlb >= 3000) {
                    $rewardshlb = intval(($system_info["wage4"] / 100) * 30000000);
                    $flag = TRUE;
                } else if ($hlb >= 1000) {
                    $rewardshlb = intval(($system_info["wage3"] / 100) * 10000000);
                    $flag = TRUE;
                } else if ($hlb >= 200) {
                    $rewardshlb = intval(($system_info["wage2"] / 100) * 2000000);
                    $flag = TRUE;
                } else if ($hlb >= 30) {
                    $rewardshlb = intval(($system_info["wage1"] / 100) * 300000);
                    $flag = TRUE;
                }
                if ($flag) {
                    //奖励元宝 
                    $title = "推广工资更新!";
                    $content = $title . "获得元宝 :" . $rewardshlb;
                    $this->updhlb($rewardshlb, 1, $content, $hlbinfo["mem_id"], 0);
                    $this->sendmessage($title, $content, 1, $hlbinfo["mem_id"]);
                }
            }
            Yii::app()->user->setFlash('msg', '上月推广工资更新成功');
        } else {
            Yii::app()->user->setFlash('msg', '上月推广工资已经更新了');
        }
        $this->redirect("show");
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $web_model = Web::model();
        $web_info = $web_model->findByPk($id);
        if (isset($_POST['Web'])) {
            foreach ($_POST['Web'] as $_k => $_v) {
                $web_info->$_k = strip_tags(trim($_v));
            }
            if ($web_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('web_model' => $web_info, 'result' => $result));
    }

    /*
     * 拒绝
     */

    function actionRefuse($id) {
        $web_model = Web::model();
        $web_info = $web_model->findByPk($id);
        if (isset($_POST['Web'])) {
            foreach ($_POST['Web'] as $_k => $_v) {
                $web_info->$_k = strip_tags($_v);
            }
            $web_info->status = "未通过";
            $web_info->cl_time = date("Y-m-d H:i:s", time());
            if ($web_info->update()) {
                Yii::app()->user->setFlash('msg', '未通过申请');
                $result = "success";
            }
        }
        $this->renderPartial('refuse', array('web_model' => $web_info, 'result' => $result));
    }

    /*
     * 同意
     */

    function actionAgree($id) {
        $web_model = Web::model();
        $web_info = $web_model->findByPk($id);
        $web_info->status = "已通过";
        $web_info->cl_time = date("Y-m-d H:i:s", time());
        $web_info->update();
        $mem_info = Mem::model()->findByPk($web_info["mem_id"]);
        $mem_info->role = 1; //表示站长
        $mem_info->update();
        Yii::app()->user->setFlash('msg', '已通过申请');
        $this->redirect("../../show");
    }

}
