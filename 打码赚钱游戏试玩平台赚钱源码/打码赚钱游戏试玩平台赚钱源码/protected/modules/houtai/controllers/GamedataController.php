<?php

/*
 * 游戏数据
 */

class GamedataController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'alldel', "rank"),
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
        $sql = "SELECT * FROM {{game_data}} where 1=1 ";
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
        $pages->params = array('start' => $start, 'end' => $end, 'game_id' => $game_id);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    //更新昨日试玩奖励
    function actionRank() {
        $hlb_model = Hlb::model();
        $num = $hlb_model->countBySql("select count(*) from {{hlb}} where TO_DAYS(create_time) = TO_DAYS(NOW()) and reason like '%试玩排行%' ");  //0表示没有更新
        if (empty($num)) {
            $rank_model = Rank::model();
            $gamegradedata_model = Gamegradedata::model();
            $sql = "select mem_id from {{game_gradedata}} WHERE  TO_DAYS(lq_time) = (TO_DAYS(NOW())-1) and game_id != 478 group by mem_id order by SUM(hlb) desc, lq_time asc";
            $rank_info = $rank_model->findAllBySql("select rewards_hlb from {{rank}} where rank_type=1  and start='已开启' order by grade ");
            foreach ($rank_info as $index => $rankinfo) {
                $gamegradedata = $gamegradedata_model->findBySql($sql . " limit " . $index . ",1");
                //奖励元宝
                $title = "试玩排行更新!";
                $content = $title . "排名第" . ($index + 1) . "名,获得元宝:" . $rankinfo["rewards_hlb"];
                $this->updhlb($rankinfo["rewards_hlb"], 3, $content, $gamegradedata["mem_id"], 0);
                $this->sendmessage($title, $content, 1, $gamegradedata["mem_id"]);
            }
            Yii::app()->user->setFlash('msg', '昨日试玩排行更新成功');
        } else {
            Yii::app()->user->setFlash('msg', '昨日试玩排行已经更新了');
        }
        $this->redirect("show");
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gamedata_model = Gamedata::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $gamedata_info = $gamedata_model->findByPk($id);
            if ($gamedata_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect("../../show");
    }

}
