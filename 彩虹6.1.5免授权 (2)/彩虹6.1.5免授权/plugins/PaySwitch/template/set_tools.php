<div class="block">
    <div class="block-title">
        <h3 class="panel-title">商品可支付类型</h3>
    </div>
    <div class="form-group form-inline checkbox {$p_ali_hidden}">
        <label>
            <input type="checkbox" class="form-control" name="p_ali_pay" value="1" %ali_pay%>
        </label>
        支付宝
    </div>
    <div class="form-group form-inline checkbox {$p_wx_hidden}">
        <label>
            <input type="checkbox" class="form-control" name="p_wx_pay" value="1" %wx_pay%>
        </label>
        微信
    </div>
    <div class="form-group form-inline checkbox {$p_qq_hidden}">
        <label>
            <input type="checkbox" class="form-control" name="p_qq_pay" value="1" %qq_pay%>
        </label>
        QQ钱包
    </div>
    <br>
    <code>默认全部支付类型，可根据需要自主取消。</code>
</div>