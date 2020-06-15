function changeinput(str) {
    $("input[name='input']").val(str);
}

function changeinputs(str) {
    $("input[name='inputs']").val(str);
}

function getFloat(number, n) {
    n = n ? parseInt(n) : 0;
    if (n <= 0) return Math.ceil(number);
    number = Math.round(number * Math.pow(10, n)) / Math.pow(10, n);
    return number;
}

function changeNum() {

    var tempDom = $("#value");

    var num = parseInt(tempDom.val());
    var price = parseFloat($("#price").val());
    var min = parseInt(tempDom.attr('min'));
    var max = parseInt(tempDom.attr('max'));
    if (num === 0 || isNaN(price))
        return false;
    $("input[name='price1']").val(getFloat(num * price, 2));
    if (min === max || num >= max) {
        $("select[name='multi']").val(0);
        $("input[name='min']").val('');
        $("input[name='max']").val('');
    } else {
        $("select[name='multi']").val(1);
        $("input[name='min']").val('');
        $("input[name='max']").val(Math.floor(max / num));
    }
    $("select[name='multi']").change();
}

function fileSelect() {
    $("#file").trigger("click");
}

function fileView() {
    var shopimg = $("#shopimg").val();
    if (shopimg === '') {
        layer.alert("请先上传图片，才能预览");
        return;
    }
    if (shopimg.indexOf('http') === -1) shopimg = '../' + shopimg;
    layer.open({
        type: 1,
        area: ['360px', '400px'],
        title: '商品图片查看',
        shade: 0.3,
        anim: 1,
        shadeClose: true,
        content: '<center><img width="300px" src="' + shopimg + '"></center>'
    });
}

function fileUpload() {
    var fileObj = $("#file")[0].files[0];
    if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
        return;
    }
    var formData = new FormData();
    formData.append("do", "upload");
    formData.append("type", "shop");
    formData.append("file", fileObj);
    var ii = layer.load(2, {shade: [0.1, '#fff']});
    $.ajax({
        url: "ajax.php?act=uploadimg",
        data: formData,
        type: "POST",
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            layer.close(ii);
            if (data.code === 0) {
                layer.msg('上传图片成功');
                $("#shopimg").val(data.url);
            } else {
                layer.alert(data.msg);
            }
        },
        error: function (data) {
            layer.close(ii);
            layer.msg('服务器错误');
            return false;
        }
    })
}
var select_input = 'curl';
function Addstr(id, str) {
    if (select_input === 'curl_post') {
        id = 'curl_post';
    }
    var tempDom = $("#" + id);
    tempDom.val(tempDom.val() + str);
}

$(document).ready(function () {
    // 监听[URL]表单字段获取焦点
    $('#curl').focus(function () {
        select_input = 'curl';
    });
    // 监听[POST]表单字段获取焦点
    $('#curl_post').focus(function () {
        select_input = 'curl_post';
    });

    var defaultDataDom = $('[data-name]');
    $.each(defaultDataDom, function (key, dom) {
        var dataName = $(dom).attr('data-name');
        if (productInfo[dataName] !== undefined) {
            $(dom).attr('default',productInfo[dataName]).val(productInfo[dataName]);
            //为了兼容之前别人写代码
        }
    });

    $("select[name='prid']").change(function () {
        if ($(this).val() == 0) {
            $("#prid0").show();
            $("#prid1").hide();
        } else {
            $("#prid1").show();
            $("#prid0").hide();
        }
    });
    $("select[name='multi']").change(function () {
        if ($(this).val() == 1) {
            $("#multi0").show();
        } else {
            $("#multi0").hide();
        }
    });
    $("select[name='is_curl']").change(function () {
        $("#shield_order_dom").hide();
        if ($(this).val() == 1) {
            $("#curl_display1").css("display", "inherit");
            $("#curl_display2").css("display", "none");
            $("#shield_order_dom").show();
        } else if ($(this).val() == 2) {
            $("#curl_display1").css("display", "none");
            $("#curl_display2").css("display", "inherit");
            $("#shield_order_dom").show();
        } else {
            $("#curl_display1").css("display", "none");
            $("#curl_display2").css("display", "none");
        }
    });
    $("select[name='shequ']").change(function () {
        $('div[data-class="kyxCommunity"]').hide();

        var type = parseInt($("select[name='shequ'] option:selected").attr("type"));
        if (type === 4) {
            $("#goods_type").css("display", "none");
            $("#goods_param").css("display", "inherit");
        } else if (type === 1 || type === 3 || type === 5 || type === 11 || type === 12) {
            $("#goods_type").css("display", "none");
            $("#goods_param").css("display", "none");
        } else if (type === 9 || type === 10) {
            $("#goods_type").css("display", "none");
            $("#goods_param").css("display", "none");
        } else if (type >= 6) {
            $("#goods_type").css("display", "none");
            $("#goods_param").css("display", "inherit");
            $('input[name="goods_id"]').val('');
            $('input[name="value"]').val('');
            $('input[name="goods_type"]').val('');
        } else {
            $("#goods_type").css("display", "inherit");
            $("#goods_param").css("display", "inherit");
        }
        if (type >= 6 && type <= 8) {
            $("#show_value").css("display", "none");
            $("#goods_id").css("display", "none");
            $("#show_goodslist").css("display", "none");
            $("#goods_param_name").html("下单页面地址：");
            if ($("input[name='goods_param']").val().indexOf('http') < 0) $("input[name='goods_param']").val("");
        } else if (type === 9) {
            $("#show_value").show();
            $("#goods_id").css("display", "inherit");
            $("#show_goodslist").css("display", "none");
        } else if (type === 10) {
            $("#show_value").css("display", "inherit");
            $("#goods_id").css("display", "inherit");
            $("#show_goodslist").css("display", "none");
            $("#goods_param_name").html("下单页面地址：");
        } else if (type === 20) {

        } else {
            $("#show_value").css("display", "inherit");
            $("#goods_id").css("display", "inherit");
            $("#show_goodslist").css("display", "inherit");
            $("#goods_param_name").html("参数名：");
        }
        if (type === 4) {
            $("#show_goodslist").css("display", "none");
        }

        if (type === 6) {
            $('div[data-class="kyxCommunity"]').show();
            //卡易信对接部分
        }

        $("#GoodsInfo").hide();
        if (!$('select[name="shequ"]').is(':hidden'))
            $('#goodslist').select2({
                placeholder: '请选择对接商品',
                language: 'zh-CN'
            });
    });
    $("#getGoods").click(function () {
        var shequ = $("select[name='shequ']").val();
        if (shequ === '') {
            layer.alert('请先选择一个对接网站');
            return false;
        }
        $('#goodslist').empty();
        var ii = layer.load(2, {shade: [0.1, '#fff']});
        $.ajax({
            type: "POST",
            url: "ajax.php?act=getGoodsList",
            data: {shequ: shequ},
            dataType: 'json',
            success: function (data) {
                layer.close(ii);
                if (data.code == 0) {
                    $('#getGoods').attr('type', data.type);
                    $.each(data.data, function (i, item) {
                        if (data.type == 'jiuwu')
                            $('#goodslist').append('<option value="' + item.id + '" goodstype="' + item.type + '" shopimg="' + item.shopimg + '" minnum="' + item.minnum + '" maxnum="' + item.maxnum + '" price="' + item.price + '">' + item.name + '</option>');
                        else if (data.type == 'yile')
                            $('#goodslist').append('<option value="' + item.id + '">' + item.name + '</option>');
                        else if (data.type == 'xingmo')
                            $('#goodslist').append('<option value="' + item.id + '" shopimg="' + item.shopimg + '">' + item.name + '</option>');
                        else if (data.type == 'jumeng')
                            $('#goodslist').append('<option value="' + item.id + '" shopimg="' + item.shopimg + '" minnum="' + item.minnum + '" maxnum="' + item.maxnum + '" price="' + item.price + '">' + item.name + '</option>');
                        else if (data.type == 'this')
                            $('#goodslist').append('<option value="' + item.id + '" cid="' + item.cid + '" shopimg="' + item.shopimg + '" price="' + item.price + '">' + item.name + '</option>');
                        else
                            $('#goodslist').append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    if (typeof ($("#goodslist").attr('default')) != 'undefined') {
                        $('#goodslist').val($("#goodslist").attr('default'));
                        if ($('#goodslist').val() != null) $("#goodslist").change();
                    }
                } else {
                    layer.alert(data.msg);
                }
            },
            error: function (data) {
                layer.close(ii);
                layer.msg('服务器错误');
                return false;
            }
        });
    });
    $("#goodslist").change(function () {
        var type = $('#getGoods').attr('type');
        if (type == 'jiuwu') {
            var shequ = $("select[name='shequ']").val();
            var goodsid = $("#goodslist option:selected").val();
            var goodstype = $("#goodslist option:selected").attr('goodstype');
            var minnum = $("#goodslist option:selected").attr('minnum');
            var maxnum = $("#goodslist option:selected").attr('maxnum');
            var shopimg = $("#goodslist option:selected").attr('shopimg');
            var price = $("#goodslist option:selected").attr('price');
            var name = $("#goodslist option:selected").html();
            $("input[name='goods_id']").val(goodsid);
            $("input[name='goods_type']").val(goodstype);
            $("input[name='shopimg']").val(shopimg);
            $("#price").val(price);
            if ($("#value").val() == '' || $("#value").val() < minnum || $("#value").val() > maxnum) $("#value").val(minnum);
            $("#value").attr('min', +minnum);
            $("#value").attr('max', +maxnum);
            if ($("input[name='name']").val() == '') $("input[name='name']").val(name);
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=getGoodsParam",
                data: {shequ: shequ, goodsid: goodsid},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $("input[name='goods_param']").val(data.param);
                        $("#GoodsInfo").html('<b>商品名称：</b><a style="color:white" href="http://' + $("select[name='shequ'] option:selected").attr('data-community-domain') + '/index.php?m=Home&c=Goods&a=detail&id=' + goodsid + '&goods_type=' + goodstype + '" target="_blank" rel="noreferrrer">' + name + '</a><br/><b>社区商品售价：</b>' + data.price + '<br/><b>最小下单数量：</b>' + minnum + '<br/><b>最大下单数量：</b>' + maxnum);
                        $("#GoodsInfo").slideDown();
                        changeNum();
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.close(ii);
                    layer.msg('服务器错误');
                    return false;
                }
            });
        } else if (type == 'yile') {
            var shequ = $("select[name='shequ']").val();
            var goodsid = $("#goodslist option:selected").val();
            var name = $("#goodslist option:selected").html();
            $("input[name='goods_id']").val(goodsid);
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=getGoodsParam",
                data: {shequ: shequ, goodsid: goodsid},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $("input[name='shopimg']").val(data.image);
                        var paramname = data.paramname;
                        var inputs = '';
                        $.each(paramname.split('|'), function (i, v) {
                            if (i == 0) {
                                $("input[name='input']").val(v);
                            } else {
                                if (v == 'QQ空间说说ID') v = '说说ID';
                                inputs += '|' + v;
                            }
                        });
                        $("input[name='inputs']").val(inputs.substr(1));
                        $("#price").val(data.price);
                        if ($("#value").val() == '' || $("#value").val() < data.limit_min || $("#value").val() > data.limit_max) $("#value").val(data.limit_min);
                        $("#value").attr('min', +data.limit_min);
                        $("#value").attr('max', +data.limit_max);
                        if ($("input[name='name']").val() == '') $("input[name='name']").val(name);
                        if ($("textarea[name='desc']").val() == '') $("textarea[name='desc']").val(data.desc);


                        $("#GoodsInfo").html('<b>商品名称：</b><a style="color:white" href="http://' + $("select[name='shequ'] option:selected").attr('data-community-domain') + '/home/order/' + goodsid + '" target="_blank" rel="noreferrrer">' + name + '</a><br/><b>商品简介：</b>' + data.desc + '<br/><b>社区商品售价：</b>' + data.price + ' 元<br/><b>最小下单数量：</b>' + data.limit_min + '<br/><b>最大下单数量：</b>' + data.limit_max);
                        $("#GoodsInfo").slideDown();
                        changeNum();
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.close(ii);
                    layer.msg('服务器错误');
                    return false;
                }
            });
        } else if (type == 'jumeng') {
            var shequ = $("select[name='shequ']").val();
            var goodsid = $("#goodslist option:selected").val();
            var minnum = $("#goodslist option:selected").attr('minnum');
            var maxnum = $("#goodslist option:selected").attr('maxnum');
            var shopimg = $("#goodslist option:selected").attr('shopimg');
            var price = $("#goodslist option:selected").attr('price');
            var name = $("#goodslist option:selected").html();
            $("input[name='goods_id']").val(goodsid);
            $("input[name='shopimg']").val(shopimg);
            if ($("input[name='name']").val() == '') $("input[name='name']").val(name);

            $("#price").val(price);
            if ($("#value").val() == '' || $("#value").val() < minnum || $("#value").val() > maxnum) $("#value").val(minnum);
            $("#value").attr('min', +minnum);
            $("#value").attr('max', +maxnum);
            $("#GoodsInfo").html('<b>商品名称：</b><a style="color:white" href="http://' + $("select[name='shequ'] option:selected").attr('data-community-domain') + '/login' + goodsid + '.html" target="_blank" rel="noreferrrer">' + name + '</a><br/><b>社区商品售价：</b>' + price + '<br/><b>最小下单数量：</b>' + minnum + '<br/><b>最大下单数量：</b>' + maxnum);
            $("#GoodsInfo").slideDown();
            changeNum();

        } else if (type == 'this') {
            var shequ = $("select[name='shequ']").val();
            var goodsid = $("#goodslist option:selected").val();
            var cid = $("#goodslist option:selected").attr('cid');
            var shopimg = $("#goodslist option:selected").attr('shopimg');
            var price = $("#goodslist option:selected").attr('price');
            var name = $("#goodslist option:selected").html();
            $("input[name='goods_id']").val(goodsid);
            $("input[name='shopimg']").val(shopimg);

            $("#price").val(price);
            $("#value").val(1);
            $("#GoodsInfo").html('<b>商品名称：</b><a style="color:white" href="http://' + $("select[name='shequ'] option:selected").attr('data-community-domain') + '/?cid=' + cid + '&tid=' + goodsid + '" target="_blank" rel="noreferrrer">' + name + '</a><br/><b>社区商品售价：</b>' + price);
            $("#GoodsInfo").slideDown();
            changeNum();

        } else {
            var goodsid = $("#goodslist option:selected").val();
            var shopimg = $("#goodslist option:selected").attr('shopimg');
            if (typeof (shopimg) != "undefined") $("input[name='shopimg']").val(shopimg);
            $("input[name='goods_id']").val(goodsid);
            $("#GoodsInfo").hide();
            $("#price").val('');
        }
    });
    $("input[name='goods_id']").blur(function () {
        var type = $("select[name='shequ'] option:selected").attr("type");
        if (type == 9) {
            var shequ = $("select[name='shequ']").val();
            var goodsid = $(this).val();
            if (goodsid == '' || goodsid == 0) return;
            var ii = layer.load(2, {shade: [0.1, '#fff']});
            $.ajax({
                type: "POST",
                url: "ajax.php?act=getGoodsParam",
                data: {shequ: shequ, goodsid: goodsid},
                dataType: 'json',
                success: function (data) {
                    layer.close(ii);
                    if (data.code == 0) {
                        $("input[name='input']").val(data.input ? data.input : '');
                        $("input[name='inputs']").val(data.inputs ? data.inputs : '');
                        $("input[name='price1']").val(getFloat(data.price, 2));
                        $("#GoodsInfo").html('<b>商品名称：</b><a style="color:white" href="http://' + $("select[name='shequ'] option:selected").attr('data-community-domain') + '/buy/' + goodsid + '" target="_blank" rel="noreferrrer">' + data.name + '</a><br/><b>商品售价：</b>' + data.price + ' 元<br/><b>最小下单数量：</b>' + data.valid_purchasing_quantity.split('-')[0] + '<br/><b>最大下单数量：</b>' + data.valid_purchasing_quantity.split('-')[1]);
                        $("#GoodsInfo").slideDown();
                    } else {
                        layer.alert(data.msg);
                    }
                },
                error: function (data) {
                    layer.close(ii);
                    layer.msg('服务器错误');
                    return false;
                }
            });
        }
    });
    // $("select[name='shequ']").change();
    // $("select[name='prid']").change();
    // $("select[name='multi']").change();
    // $("input[name='goods_id']").val($("input[name='goods_id']").attr('value')).blur();
    //这坨不知道干什么用的 反正他导致了一系列的bug

    $('select[name="cid"]').select2({
        placeholder: '请选择商品分类',
        language: 'zh-CN'
    });

    //--------------------卡易信对接开始--------------------
    $('#kyxGetCategory').click(function () {
        var loadTemp = layer.load();

        var communityID = $('select[name="shequ"]').val();
        $.getJSON('./ajax.php', {
            act: 'getKyxCategory',
            communityID: communityID
        }, function (data) {
            layer.close(loadTemp);
            if (data['code'] !== 0) {
                layer.alert(data['msg']);
                return true;
            }

            var tempDom = $('#kyxCategory').empty();

            $.each(data['data']['categoryList'], function (key, content) {
                var optionDom = document.createElement('option');
                $(optionDom).text(content['name']).attr({
                    'data-id': content['id'],
                    'data-request-domain': data['data']['requestDomain']
                });
                tempDom.append(optionDom);
            });

            tempDom.select2({
                placeholder: '请选择分类',
                language: 'zh-CN'
            });
        });
    });

    $('#kyxCategory').change(function () {
        var selectDomain = $('#kyxCategory option:selected');

        var loadTemp = layer.load();

        $.post('./ajax.php?act=getKyxProductList', {
            requestDomain: selectDomain.attr('data-request-domain'),
            storeID: selectDomain.attr('data-id')
        }, function (data) {
            layer.close(loadTemp);
            if (data['code'] !== 0) {
                layer.alert(data['msg']);
                return true;
            }

            var tempDom = $('#kyxProductList').empty();

            if (data['data'] === undefined)
                return true;

            $.each(data['data'], function (key, content) {
                var optionDom = document.createElement('option');
                $(optionDom).text(content['name']).attr({
                    'data-id': content['id'],
                    'data-price': content['price'],
                    'data-good-id': content['goodID'],
                    'data-key-id': content['keyID']
                });
                tempDom.append(optionDom);
            });

            tempDom.change();

            tempDom.select2({
                placeholder: '请选择一级分类',
                language: 'zh-CN'
            });
        });
    });
    $('#kyxProductList').change(function () {
        var categorySelectDom = $('#kyxCategory option:selected');
        var productSelectDom = $('#kyxProductList option:selected');

        var buildUrl = categorySelectDom.attr('data-request-domain') + '/front/inter/buyGoods.htm?goodId=' + productSelectDom.attr('data-good-id') + '&keyId=' + productSelectDom.attr('data-key-id') + '&dirId=' + categorySelectDom.attr('data-id');

        $('input[name="goods_param"]').val(buildUrl);
        $('input[name="name"]').val(productSelectDom.text());
        $('input[name="price1"]').val(productSelectDom.attr('data-price'));
        $('input[name="min"]').val(1);
        $('input[name="max"]').val(10);

        var html = `<b>商品名称：</b><a style="color:white" href="${buildUrl}" target="_blank" rel="noreferrrer">${productSelectDom.text()}</a><br>`;
        html += `<b>社区商品售价：</b>${productSelectDom.attr('data-price')}元 / 件<br>`;
        html += '<b>最小下单数量：</b>1<br>';
        html += '<b>最大下单数量：</b>10';

        $('#GoodsInfo').html(html).show();
    });
    //--------------------卡易信对接结束--------------------

    $.getJSON('./ajax.php?act=getPriceModelList', function (data) {
        if (data['code'] !== 0) {
            return;
        }
        if (data['data'].length === 0)
            return;
        var tempDom = $('select[name="prid"]');
        $.each(data['data'], function (key, value) {
            tempDom.append(`<option value="${value['id']}" kind="${value['kind']}" p_2="${value['p_2']}" p_1="${value['p_1']}" p_0="${value['p_0']}">${value['name']}</option>`);
        });

        tempDom.select2({
            placeholder: '请选择加价模板',
            language: 'zh-CN'
        });

        var items = $("select[default]");
        for (i = 0; i < items.length; i++) {
            var selectDomain = $(items[i]);
            if (selectDomain.is('#goodslist'))
                continue;
            selectDomain.val(selectDomain.attr("default") || 0).change();
        }
    });
});
