<div id="top">
    <div id="top_logo">
        <img alt="logo" src="<?php echo IMG_URL;?>common/logo.gif" width="274" height="49" style="vertical-align:middle;">
    </div>
    <div id="top_links">
        <div id="top_op">
            <ul>
                <li>
                    <img alt="当前用户" src="<?php echo IMG_URL;?>common/user.jpg">：
                    <span><?php $this->renderDynamic('admin_name');echo "&nbsp;欢迎回来！"; ?></span>
                </li>
                <li>
                    <img alt="当前日期" src="<?php echo IMG_URL;?>common/month.jpg">：
                    <span id="yue_fen"></span>
                </li>
            </ul> 
        </div>
        <div id="top_close">
            <a href="javascript:void(0);" onclick="logout();" target="_parent">
                <img alt="退出系统" title="退出系统" src="<?php echo IMG_URL;?>common/close.jpg" style="position: relative; top: 10px; left: 25px;">
            </a>
        </div>
    </div>
</div>