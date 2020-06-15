<?php 
function plugin_install()
{
    if(!get_plugin_install_state("w_list_style"))
    {
        $sqlsex = 'ALTER TABLE `hy_user` ADD `sex` int(2) NOT NULL default \'2\' COMMENT \'性别\';';
        $sqlyear = 'ALTER TABLE `hy_user` ADD `year` VARCHAR(10) NOT NULL default \'1996\' COMMENT \'年\';';
        $sqlmonth = 'ALTER TABLE `hy_user` ADD `month` VARCHAR(10) NOT NULL default \'2\' COMMENT \'月\';';
        $sqlday = 'ALTER TABLE `hy_user` ADD `day` VARCHAR(10) NOT NULL default \'20\' COMMENT \'日\';';
        $data = S("user");
       if($data -> query($sqlsex) && $data -> query($sqlyear) && $data -> query($sqlmonth) && $data -> query($sqlday))
        {
            file_put_contents(PLUGIN_PATH."w_list_style/on","");
            return true;
        }else{
           return false;
       }
    }else{
        return false;
    }
}
function plugin_uninstall(){
    return true;
}