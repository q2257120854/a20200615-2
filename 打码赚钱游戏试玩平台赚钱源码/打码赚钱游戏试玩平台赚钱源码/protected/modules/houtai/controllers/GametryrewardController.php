<?php

/*
 * 试玩奖励
 */

class GametryrewardController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', 'alldel'),
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
        $gameid = $_GET['gameid'];
        $sql = "SELECT * FROM {{game_tryreward}} where game_id=" . $gameid . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($gameid)) {
            $pages->params = array('gameid' => $gameid);
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages));
    }

    /*
     * 添加
     */

    function actionAdd() {
        $gameid = $_GET['gameid'];
        $tryreward_model = new Gametryreward();
        if (isset($_POST['Gametryreward'])) {
            foreach ($_POST['Gametryreward'] as $_k => $_v) {
                $tryreward_model->$_k = strip_tags($_v);
            }
            if ($tryreward_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('tryreward_model' => $tryreward_model, 'result' => $result, "gameid" => $gameid));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $tryreward_model = Gametryreward::model();
        $tryreward_info = $tryreward_model->findByPk($id);
        if (isset($_POST['Gametryreward'])) {
            foreach ($_POST['Gametryreward'] as $_k => $_v) {
                $tryreward_info->$_k = strip_tags($_v);
            }
            if ($tryreward_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('tryreward_model' => $tryreward_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
        $gameid = $_GET['gameid'];
        $tryreward_model = Gametryreward::model();
        $tryreward_info = $tryreward_model->findByPk($id);
        if (empty($tryreward_info['valid'])) {
            if ($tryreward_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
                $this->redirect(SITE_URL . "houtai/gameimpact/show/gameid/" . $gameid);
            }
        } else {
            Yii::app()->user->setFlash('msg', '奖励已领取，不能删除');
            $this->redirect(SITE_URL . "houtai/gameimpact/show/gameid/" . $gameid);
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $gameid = $_GET['gameid'];
        $impact_model = Gameimpact::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $impact_info = $impact_model->findByPk($id);
            if (empty($impact_info['valid'])) {
                if (!$impact_info->delete()) {
                    Yii::app()->user->setFlash('msg', "排名" . $impact_info['ranking'] . '，奖励已领取，不能删除');
                    $this->redirect(SITE_URL . "houtai/gameimpact/show/gameid/" . $gameid);
                }
            }
        }
        Yii::app()->user->setFlash('msg', '删除成功');
        $this->redirect(SITE_URL . "houtai/gameimpact/show/gameid/" . $gameid);
    }

}
