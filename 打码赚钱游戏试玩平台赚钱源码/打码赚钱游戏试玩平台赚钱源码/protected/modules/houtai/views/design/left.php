<div id="side">
    <div id="left_menu">
        <ul id="TabPage2" style="height:200px; margin-top:50px;">
            <li id="left_tab1" class="selected" onClick="javascript:switchTab('TabPage2', 'left_tab1');" title="业务模块">
                <img alt="业务模块" title="业务模块" src="<?php echo IMG_URL;?>common/1_hover.jpg" width="33" height="31">
            </li>
            <li id="left_tab2" onClick="javascript:switchTab('TabPage2', 'left_tab2');" title="系统管理">
                <img alt="系统管理" title="系统管理" src="<?php echo IMG_URL;?>common/2.jpg" width="33" height="31">
            </li>		
            <li id="left_tab3" onClick="javascript:switchTab('TabPage2', 'left_tab3');" title="其他">
                <img alt="其他" title="其他" src="<?php echo IMG_URL;?>common/3.jpg" width="33" height="31">
            </li>
        </ul>
        <div id="nav_show" style="position:absolute; bottom:0px; padding:10px;">
            <a href="javascript:;" id="show_hide_btn">
                <img alt="显示/隐藏" title="显示/隐藏" src="<?php echo IMG_URL;?>common/nav_hide.png" width="35" height="35">
            </a>
        </div>
    </div>
    <div id="left_menu_cnt">
        <div id="nav_module">
            <img src="<?php echo IMG_URL;?>common/module_1.png" width="210" height="58"/>
        </div>
        <div id="nav_resource">
            <ul id="dleft_tab1" class="ztree"></ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#TabPage2 li').click(function() {
            var index = $(this).index();
            $(this).find('img').attr('src', '<?php echo IMG_URL;?>common/' + (index + 1) + '_hover.jpg');
            $(this).css({background: '#fff'});
            $('#nav_module').find('img').attr('src', '<?php echo IMG_URL;?>common/module_' + (index + 1) + '.png');
            $('#TabPage2 li').each(function(i, ele) {
                if (i != index) {
                    $(ele).find('img').attr('src', '<?php echo IMG_URL;?>common/' + (i + 1) + '.jpg');
                    $(ele).css({background: '#044599'});
                }
            });
            // 显示侧边栏
            switchSysBar(true);
        });
        // 显示隐藏侧边栏
        $("#show_hide_btn").click(function() {
            switchSysBar();
        });
    });

    /**隐藏或者显示侧边栏**/
    function switchSysBar(flag) {
        var side = $('#side');
        var left_menu_cnt = $('#left_menu_cnt');
        if (flag == true) {	// flag==true
            left_menu_cnt.show(500, 'linear');
            side.css({width: '280px'});
            $('#top_nav').css({width: '77%', left: '304px'});
            $('#main').css({left: '280px'});
        } else {
            if (left_menu_cnt.is(":visible")) {
                left_menu_cnt.hide(10, 'linear');
                side.css({width: '60px'});
                $('#top_nav').css({width: '100%', left: '60px', 'padding-left': '28px'});
                $('#main').css({left: '60px'});
                $("#show_hide_btn").find('img').attr('src', '<?php echo IMG_URL;?>common/nav_show.png');
            } else {
                left_menu_cnt.show(500, 'linear');
                side.css({width: '280px'});
                $('#top_nav').css({width: '77%', left: '304px', 'padding-left': '0px'});
                $('#main').css({left: '280px'});
                $("#show_hide_btn").find('img').attr('src', '<?php echo IMG_URL;?>common/nav_hide.png');
            }
        }
    }
</script>