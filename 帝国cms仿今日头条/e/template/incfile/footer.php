<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<div class="sfoot_p">
        <div class="sfoot">
            <div>
                <a href="mailto:mp@toutiao.com" class="sfoot_email">客服邮箱：<?=$public_r['add_jubao']?></a>|
                <a target="_blank" href="#" class="sfoot_selfservice">常见问题</a>
            </div>
            <div>
                <a target="_blank" class="sfoot_about" href="#">关于<?=$public_r['add_sitetitle']?></a>|
                <a target="_blank" href="#" class="sfoot_agreement">用户协议</a>|
                
                    <a target="_blank" href="#" class="sfoot_agreement">侵权投诉</a>|
                
                <a target="_blank" href="#" class="sfoot_contact">联系我们</a>
                &copy; 2016 <?=$public_r['add_sitetitle']?> <?=$public_r['add_siteurl']?>
            </div>
        </div>
    </div>
    
    <div id="wx-feedback"></div>
    <div id="backtop" onclick="backtop();">返回顶部</div>
    <!--  -->

<?=EcmsShowThisMemberMenu()?>
</body>
</html>


<!--[if lt IE 8 ]>
<script type="text/javascript">
$(function(){
setTimeout(function(){
    var err=[
        '抱歉，平台部分功能无法支持你的浏览器。为保证平台体验，请下载使用<a target="_blank" href="http://www.baidu.com/s?ie=utf-8&wd=%E8%B0%B7%E6%AD%8C%E6%B5%8F%E8%A7%88%E5%99%A8">谷歌浏览器</a>。 ',
        '如果是双核浏览器，请切换到高速 / 极速 / 神速核心。'
        ];
    var ele=document.getElementById('browser_err');
    ele.innerHTML='<div>'+err.join('<br/>')+'</div>';
    ele.style.display='block';
},20);
});
</script>
<![endif]-->