<?php

/*
 * 广告体验等级
 */

class ExpadgradeController extends Controller {

    function filters() {
        return array(
            'accessControl',
        );
    }
    
    function accessRules() {
        return array(
            array('allow', // 只允许用户名是admin的用户 
                'actions' => array('show', 'add', 'edit', 'del', 'alldel',"refresh","zc"),
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
        $expadid = $_GET['expadid'];
        $sql = "SELECT * FROM {{exp_ad_grade}} where exp_ad_id=" . $expadid . " order by id desc";
        $criteria = new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages = new CPagination($result->rowCount);
        $pages->pageSize = 10;
        if (!empty($expadid)) {
            $pages->params = array('expadid' => $expadid);
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
        $expadid = $_GET['expadid'];
        $expadgrade_model = new Expadgrade();
        if (isset($_POST['Expadgrade'])) {
            foreach ($_POST['Expadgrade'] as $_k => $_v) {
                $expadgrade_model->$_k = strip_tags($_v);
            }
            if ($expadgrade_model->save()) {
                Yii::app()->user->setFlash('msg', '添加成功');
                $result = "success";
            }
        }
        $this->renderPartial('add', array('expadgrade_model' => $expadgrade_model, 'result' => $result, "expadid" => $expadid));
    }

    /*
     * 修改
     */

    function actionEdit($id) {
        $expadgrade_model = Expadgrade::model();
        $expadgrade_info = $expadgrade_model->findByPk($id);
        if (isset($_POST['Expadgrade'])) {
            foreach ($_POST['Expadgrade'] as $_k => $_v) {
                $expadgrade_info->$_k = strip_tags($_v);
            }
            if ($expadgrade_info->save()) {
                Yii::app()->user->setFlash('msg', '修改成功');
                $result = "success";
            }
        }
        $this->renderPartial('edit', array('expadgrade_model' => $expadgrade_info, 'result' => $result));
    }

    /*
     * 删除
     */

    function actionDel($id) {
         $expadid = $_GET['expadid'];
        $expadgrade_model = Expadgrade::model();
        $expadgrade_info = $expadgrade_model->findByPk($id);
        if ($expadgrade_info->delete()) {
            Yii::app()->user->setFlash('msg', '删除成功');
            $this->redirect(SITE_URL . "houtai/expadgrade/show/expadid/" . $expadid);
        }
    }

    /*
     * 批量删除
     */

    function actionAlldel($ids) {
        $expadid = $_GET['expadid'];
        $expadgrade_model = Expadgrade::model();
        $arr = explode(",", $ids);
        foreach ($arr as $id) {
            $expadgrade_info = $expadgrade_model->findByPk($id);
            $expadgrade_info->delete();
        }
        Yii::app()->user->setFlash('msg', '删除成功');
        $this->redirect(SITE_URL . "houtai/expadgrade/show/expadid/" . $expadid);
    }

}
