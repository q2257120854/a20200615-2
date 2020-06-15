<?php

/*
 * 帮助中心
 */

class HelpController extends Controller {
    
    
    /*
     * 展示
     */

    function actionShow() {
        $id = 1;
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        }
        $sql = "SELECT * FROM {{help}} where help_type_id=" . $id;
        $sql = $sql ;
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
        $this->renderPartial('show', array('posts' => $posts, 'pages' => $pages, 'id' => $id),"",$processOutput=TRUE);
    }

    

}
