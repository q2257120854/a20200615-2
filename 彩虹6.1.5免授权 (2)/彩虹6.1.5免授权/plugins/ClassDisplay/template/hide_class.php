<script src="http://ip.ws.126.net/ipquery" type="text/javascript"></script>
<script>
    function p_isPC() {
        let userAgentInfo = navigator.userAgent;
        let Agents = ['Android', 'iPhone', 'SymbianOS', 'Windows Phone', 'iPad', 'iPod'];
        let flag = true;
        for (let v = 0, len = Agents.length; v < len; v++) {
            if (userAgentInfo.indexOf(Agents[v]) > 0) {
                flag = false;
                break;
            }
        }
        return flag;
    }

    let hideData = '{$list}';
    let conf = '{$conf}';
    if (!conf) {
        conf = {'type': 1};
    }
    conf['type'] = parseInt(conf['type']);
    if (1 === conf['type']) {
        p_setRegion();
    } else if (2 === conf['type']) {
        if (!p_isPC()) p_setRegion();
    } else if (3 === conf['type']) {
        if (p_isPC()) p_setRegion();
    }

    function p_setRegion() {
        $('#cid option').each(function (i, item) {
            let key = parseInt($(item).val());
            var city = localAddress["city"] + localAddress["province"];
            if (hideData.hasOwnProperty(key)) {
                for (let str of hideData[key]) {
                    if (city.indexOf(str) > -1) {
                        $(item).remove();
                        break;
                    }
                }
            }
        });
        $.each(hideData, function (key, content) {
            var tempDom = $('#collapse' + key);
            if (tempDom.length === 0)
                return true;
            tempDom.parent().remove();
        });
    }
</script>
