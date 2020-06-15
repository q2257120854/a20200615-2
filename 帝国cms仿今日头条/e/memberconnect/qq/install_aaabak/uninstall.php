<?php
if(!defined('InEmpireCMS'))
{
        exit();
}

//------ QQ登录插件卸载 ------

//删除QQ登录应用记录
$empire->query("delete from {$dbtbpre}enewsmember_connect_app where apptype='qq';");

GetConfig();

?>