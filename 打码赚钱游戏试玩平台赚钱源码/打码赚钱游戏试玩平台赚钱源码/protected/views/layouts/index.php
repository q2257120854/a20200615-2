<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" ></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>、后台管理系统</title>
        <link href="/style/authority/main_css.css" rel="stylesheet" type="text/css" />
        <link href="/style/authority/zTreeStyle.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/scripts/jquery/jquery-1.7.1.js"></script>
        <script type="text/javascript" src="/scripts/zTree/jquery.ztree.core-3.2.js"></script>
        <script type="text/javascript" src="/scripts/authority/commonAll.js"></script>
        <script type="text/javascript">
            /**退出系统**/
            function logout() {
                if (confirm("您确定要退出本系统吗？")) {
                    window.location.href = "<?php echo SITE_URL ?>houtai/login/logout";
                }
            }
            /**获得当前日期**/
            function  getDate01() {
                var time = new Date();
                var myYear = time.getFullYear();
                var myMonth = time.getMonth() + 1;
                var myDay = time.getDate();
                var mytime = time.toLocaleTimeString();     //获取当前时间
                if (myMonth < 10) {
                    myMonth = "0" + myMonth;
                }
                document.getElementById("yue_fen").innerHTML = myYear + "." + myMonth + "." + myDay;
            }
        </script>
        <script type="text/javascript">
            /* zTree插件加载目录的处理  */
            var zTree;
            var setting = {
                view: {
                    dblClickExpand: false,
                    showLine: false,
                    expandSpeed: ($.browser.msie && parseInt($.browser.version) <= 6) ? "" : "fast"
                },
                data: {
                    key: {
                        name: "resourceName"
                    },
                    simpleData: {
                        enable: true,
                        idKey: "resourceID",
                        pIdKey: "parentID",
                        rootPId: ""
                    }
                },
                callback: {
                    onClick: zTreeOnClick
                }
            };

            var curExpandNode = null;
            function beforeExpand(treeId, treeNode) {
                var pNode = curExpandNode ? curExpandNode.getParentNode() : null;
                var treeNodeP = treeNode.parentTId ? treeNode.getParentNode() : null;
                for (var i = 0, l = !treeNodeP ? 0 : treeNodeP.children.length; i < l; i++) {
                    if (treeNode !== treeNodeP.children[i]) {
                        zTree.expandNode(treeNodeP.children[i], false);
                    }
                }
                while (pNode) {
                    if (pNode === treeNode) {
                        break;
                    }
                    pNode = pNode.getParentNode();
                }
                if (!pNode) {
                    singlePath(treeNode);
                }

            }


            function singlePath(newNode) {
                if (newNode === curExpandNode)
                    return;
                if (curExpandNode && curExpandNode.open == true) {
                    if (newNode.parentTId === curExpandNode.parentTId) {
                        zTree.expandNode(curExpandNode, false);
                    } else {
                        var newParents = [];
                        while (newNode) {
                            newNode = newNode.getParentNode();
                            if (newNode === curExpandNode) {
                                newParents = null;
                                break;
                            } else if (newNode) {
                                newParents.push(newNode);
                            }
                        }
                        if (newParents != null) {
                            var oldNode = curExpandNode;
                            var oldParents = [];
                            while (oldNode) {
                                oldNode = oldNode.getParentNode();
                                if (oldNode) {
                                    oldParents.push(oldNode);
                                }
                            }
                            if (newParents.length > 0) {
                                for (var i = Math.min(newParents.length, oldParents.length) - 1; i >= 0; i--) {
                                    if (newParents[i] !== oldParents[i]) {
                                        zTree.expandNode(oldParents[i], false);
                                        break;
                                    }
                                }
                            } else {
                                zTree.expandNode(oldParents[oldParents.length - 1], false);
                            }
                        }
                    }
                }
                curExpandNode = newNode;
            }

            function onExpand(event, treeId, treeNode) {
                curExpandNode = treeNode;
            }

            /** 用于捕获节点被点击的事件回调函数  **/
            function zTreeOnClick(event, treeId, treeNode) {
                var zTree = $.fn.zTree.getZTreeObj("dleft_tab1");
                zTree.expandNode(treeNode, null, null, null, true);
                // 		zTree.expandNode(treeNode);
                // 规定：如果是父类节点，不允许单击操作
                if (treeNode.isParent) {
                    return false;
                }
                // 如果节点路径为空或者为"#"，不允许单击操作
                if (treeNode.accessPath == "" || treeNode.accessPath == "#") {

                    return false;
                }
                // 跳到该节点下对应的路径, 把当前资源ID(resourceID)传到后台，写进Session
                rightMain(treeNode.accessPath);
                if (treeNode.isParent) {
                    $('#here_area').html('当前位置：' + treeNode.getParentNode().resourceName + '&nbsp;>&nbsp;<span style="color:#1A5CC6">' + treeNode.resourceName + '</span>');
                } else {
                    $('#here_area').html('当前位置：系统&nbsp;>&nbsp;<span style="color:#1A5CC6">' + treeNode.resourceName + '</span>');
                }
            }
            ;

            /* 上方菜单 */
            function switchTab(tabpage, tabid) {
                var oItem = document.getElementById(tabpage).getElementsByTagName("li");
                for (var i = 0; i < oItem.length; i++) {
                    var x = oItem[i];
                    x.className = "";
                }
                if ('left_tab1' == tabid) {
                    $(document).ajaxStart(onStart).ajaxSuccess(onStop);
                    // 异步加载"业务模块"下的菜单
                    loadMenu('YEWUMOKUAI', 'dleft_tab1');
                } else if ('left_tab2' == tabid) {
                    $(document).ajaxStart(onStart).ajaxSuccess(onStop);
                    // 异步加载"系统管理"下的菜单
                    loadMenu2('XITONGMOKUAI', 'dleft_tab1');
                } else if ('left_tab3' == tabid) {
                    $(document).ajaxStart(onStart).ajaxSuccess(onStop);
                    // 异步加载"其他"下的菜单
                    loadMenu3('QITAMOKUAI', 'dleft_tab1');
                }
            }


            $(document).ready(function() {
                $(document).ajaxStart(onStart).ajaxSuccess(onStop);
                /** 默认异步加载"业务模块"目录  **/
                loadMenu('YEWUMOKUAI', "dleft_tab1");
                // 默认展开所有节点
                if (zTree) {
                    // 默认展开所有节点
                    zTree.expandAll(true);
                }
            });

            function loadMenu(resourceType, treeObj) {
<?php $data = $this->role_menu($this->show_roleid(), 1); ?>
                data = [<?php echo $data ?>];
                // 如果返回数据不为空，加载"业务模块"目录
                if (data != null) {
                    $.fn.zTree.init($("#" + treeObj), setting, data);
                    zTree = $.fn.zTree.getZTreeObj(treeObj);
                    if (zTree) {
                        zTree.expandAll(true);
                    }
                }
            }

            function loadMenu2(resourceType, treeObj) {
<?php $data = $this->role_menu($this->show_roleid(), 2); ?>
                data = [<?php echo $data ?>];
                // 如果返回数据不为空，加载"业务模块"目录
                if (data != null) {
                    $.fn.zTree.init($("#" + treeObj), setting, data);
                    zTree = $.fn.zTree.getZTreeObj(treeObj);
                    if (zTree) {
                        zTree.expandAll(true);
                    }
                }
            }

            function loadMenu3(resourceType, treeObj) {
<?php $data = $this->role_menu($this->show_roleid(), 3); ?>
                data = [<?php echo $data ?>];
                // 如果返回数据不为空，加载"业务模块"目录
                if (data != null) {
                    $.fn.zTree.init($("#" + treeObj), setting, data);
                    zTree = $.fn.zTree.getZTreeObj(treeObj);
                    if (zTree) {
                        zTree.expandAll(true);
                    }
                }
            }

            function onStart() {
                $("#ajaxDialog").show();
            }
            function onStop() {
                $("#ajaxDialog").hide();
            }
        </script>
    </head>
    <body onload="getDate01()">
        <?php $a_urls = 'protected/modules/houtai/views/design'; ?>   
        <?php include $a_urls . '/header.php'; ?>
        <?php include $a_urls . '/left.php'; ?>
        <?php echo $content; ?>
    </body>
</html>

