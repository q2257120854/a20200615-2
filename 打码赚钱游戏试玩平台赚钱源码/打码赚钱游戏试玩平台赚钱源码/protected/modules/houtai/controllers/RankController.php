<?php

/*
 * 排行管理
 */

class RankController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }

    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', 'alldel', "start"),
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

    function actionShow($typeid) {
        $sql = "SELECT * FROM {{rank}} where rank_type=" . $typeid;
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
        $pages->params = array('name' => $name, 'typeid' => $typeid);
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        $posts = $result->query();
        $this->render('show', array('posts' => $posts, 'pages' => $pages, "typeid" => $typeid));
    }

    /*
     * 开启状态
     */

    function actionStart($typeid, $id) {
        $rank_model = Rank::model();
        $rank_info = $rank_model->findByPk($id);
        if ($rank_info["start"] == "已开启") {
            $rank_info->start = "已关闭";
        } else {
            $rank_info->start = "已开启";
        }
        $rank_info->update();
        Yii::app()->user->setFlash('msg', '状态修改成功');
        $this->redirect(SITE_URL . "houtai/rank/show/typeid/" . $typeid);
    }

    /*
     * 添加
     */

    function actionAdd($typeid) {
        $rank_model = new Rank();
        if (isset($_POST['Rank'])) {
            foreach ($_POST['Rank'] as $_k => $_v) {
                $rank_model->$_k = strip_tags($_v);
            }
            if ($rank_model->save()) {
                Yii::app()->user->setFlash('msg', '添加排名成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('rank_model' => $rank_model, 'result' => $result,"typeid"=>$typeid));
    }

    /*
     * 修改
     */

    function actionEdit($typeid, $id) {
        $rank_model = Rank::model();
        $rank_info = $rank_model->findByPk($id);
        if (isset($_POST['Rank'])) {
            foreach ($_POST['Rank'] as $_k => $_v) {
                $rank_info->$_k = strip_tags($_v);
            }
            if ($rank_info->save()) {
                Yii::app()->user->setFlash('msg', '修改排名成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('rank_model' => $rank_info, 'result' => $result));
    }
    
    /*
     * 删除
     */

    function actionDel($typeid, $id) {
        $rank_model = Rank::model();
        $rank_info = $rank_model->findByPk($id);
        if ($rank_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect(SITE_URL . "houtai/rank/show/typeid/" . $typeid);
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($typeid, $ids) {
        $rank_model = Rank::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $rank_info = $rank_model->findByPk($id);
            if ($rank_info->delete()) {
                Yii::app()->user->setFlash('msg', '删除成功');
            }
        }
        $this->redirect(SITE_URL . "houtai/rank/show/typeid/" . $typeid);
    }

}
