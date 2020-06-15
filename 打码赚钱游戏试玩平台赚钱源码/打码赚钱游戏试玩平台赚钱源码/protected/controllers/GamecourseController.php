<?php

/*
 * 试玩教程
 */

class GamecourseController extends Controller {
    
    
    /*
     * 展示
     */

    function actionShow() {
       
        $this->renderPartial('show');
    }
}
