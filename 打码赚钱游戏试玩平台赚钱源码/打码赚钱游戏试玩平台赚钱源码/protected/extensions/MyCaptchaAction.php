<?php

class MyCaptchaAction extends CCaptchaAction {

    const SESSION_VAR_PREFIX = 'Ext.MyCaptchaAction.';

    protected function generateVerifyCode() {
        
        $code = '';
        for ($i = 0; $i < 4; ++$i) {
            $code.=rand(2, 9);
        }
        return $code;
    }

}
