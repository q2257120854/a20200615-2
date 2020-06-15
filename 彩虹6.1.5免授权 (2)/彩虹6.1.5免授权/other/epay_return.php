<?php
/* * 
 * 功能：易支付页面跳转同步通知页面
 * 版本：4.0
 * 日期：2020/03/02
 */
require_once '../includes/common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title>订单创建中，请耐心等候</title>
</head>
<body>
<noscript>请开启浏览器Javascript功能，否则无法正常为您创建订单</noscript>
<div id="root">
    <style>
        .page-loading-warp {
            padding: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .ant-spin {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            color: rgba(0, 0, 0, 0.65);
            font-size: 14px;
            font-variant: tabular-nums;
            line-height: 1.5;
            list-style: none;
            -webkit-font-feature-settings: 'tnum';
            font-feature-settings: 'tnum';
            position: absolute;
            display: none;
            color: #1890ff;
            text-align: center;
            vertical-align: middle;
            opacity: 0;
            -webkit-transition: -webkit-transform 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86);
            transition: -webkit-transform 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86);
            transition: transform 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86),
            -webkit-transform 0.3s cubic-bezier(0.78, 0.14, 0.15, 0.86);
        }

        .ant-spin-spinning {
            position: static;
            display: inline-block;
            opacity: 1;
        }

        .ant-spin-dot {
            position: relative;
            display: inline-block;
            font-size: 20px;
            width: 20px;
            height: 20px;
        }

        .ant-spin-dot-item {
            position: absolute;
            display: block;
            width: 9px;
            height: 9px;
            background-color: #1890ff;
            border-radius: 100%;
            -webkit-transform: scale(0.75);
            -ms-transform: scale(0.75);
            transform: scale(0.75);
            -webkit-transform-origin: 50% 50%;
            -ms-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            opacity: 0.3;
            -webkit-animation: antSpinMove 1s infinite linear alternate;
            animation: antSpinMove 1s infinite linear alternate;
        }

        .ant-spin-dot-item:nth-child(1) {
            top: 0;
            left: 0;
        }

        .ant-spin-dot-item:nth-child(2) {
            top: 0;
            right: 0;
            -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s;
        }

        .ant-spin-dot-item:nth-child(3) {
            right: 0;
            bottom: 0;
            -webkit-animation-delay: 0.8s;
            animation-delay: 0.8s;
        }

        .ant-spin-dot-item:nth-child(4) {
            bottom: 0;
            left: 0;
            -webkit-animation-delay: 1.2s;
            animation-delay: 1.2s;
        }

        .ant-spin-dot-spin {
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-animation: antRotate 1.2s infinite linear;
            animation: antRotate 1.2s infinite linear;
        }

        .ant-spin-lg .ant-spin-dot {
            font-size: 32px;
            width: 32px;
            height: 32px;
        }

        .ant-spin-lg .ant-spin-dot i {
            width: 14px;
            height: 14px;
        }

        @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
            .ant-spin-blur {
                background: #fff;
                opacity: 0.5;
            }
        }

        @-webkit-keyframes antSpinMove {
            to {
                opacity: 1;
            }
        }

        @keyframes antSpinMove {
            to {
                opacity: 1;
            }
        }

        @-webkit-keyframes antRotate {
            to {
                -webkit-transform: rotate(405deg);
                transform: rotate(405deg);
            }
        }

        @keyframes antRotate {
            to {
                -webkit-transform: rotate(405deg);
                transform: rotate(405deg);
            }
        }
    </style>
    <div class="page-loading-warp">
        <div class="ant-spin ant-spin-lg ant-spin-spinning">
          <span class="ant-spin-dot ant-spin-dot-spin"
          ><i class="ant-spin-dot-item"></i><i class="ant-spin-dot-item"></i
              ><i class="ant-spin-dot-item"></i><i class="ant-spin-dot-item"></i
              ></span>
            <p>正在为您创建生成订单，请耐心等候</p>
            <p>将为在2~10秒内完成</p>
        </div>
    </div>
    <script src="https://cdn.staticfile.org/Base64/1.1.0/base64.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/1.12.4/jquery.min.js"></script>
    <script>
        $(function ($) {
            <?php  ?>
            var returnData = '<?php echo base64_encode(json_encode($_GET)); ?>';
            returnData = atob(returnData);

            function checkOrderData() {
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '/ajax.php?act=epayOrderReturnCheck',
                    timeout: 60000, //ajax请求超时时间60s
                    data: {
                        verifyData: returnData
                    },
                    success: function (data) {
                        //从服务器得到数据，显示数据并继续查询
                        if (data['code'] === 0) {
                            alert(data['msg']);
                            if (data['data']['tid'] === '-1') {
                                window.location.href = '../user/';
                            } else {
                                window.location.href = '../?buyok=1';
                            }
                        } else {
                            alert(data['msg']);
                        }
                    },
                    //Ajax请求超时，继续查询
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        if (textStatus === 'timeout') {
                            alert('校验订单状态超时，请刷新页面重试');
                        } else { //异常
                            alert('校验订单异常,' + textStatus);
                        }
                        window.location.reload();
                    }
                });
            }

            window.onload = checkOrderData;
        });
    </script>
</div>
</body>
</html>
