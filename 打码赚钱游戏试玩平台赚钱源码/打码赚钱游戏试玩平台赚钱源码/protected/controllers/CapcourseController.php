<?php

/*
 * 打码教程
 */

class CapcourseController extends Controller {
    
    
     /*
     * 展示
     */

    function actionShow() {
       
        $this->renderPartial('show');
    }
}
