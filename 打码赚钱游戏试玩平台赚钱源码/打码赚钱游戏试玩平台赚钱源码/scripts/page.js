//el:分页容器 count:总记录数 pageStep:每页显示多少个 pageNum:第几页 fnGo:分页跳转函数
var jsPage = function(el, count, pageStep, pageNum, fnGo) {


    this.getLink = function(fnGo, index, pageNum, text) {
        var s = '<a href="#p' + index + '" onclick="' + fnGo + '(' + index + ');" ';
        if (index == pageNum) {
            s += 'class="aCur" ';
        }
        //上一页
        if (index < pageNum) {
            s += 'class="aCur sy" ';
        }
        //下一页
        if (index > pageNum) {
            s += 'class="aCur xy" ';
        }
        text = text || index;
        s += '>' + text + '</a> ';
        return s;
    }
    //总页数
    var pageNumAll = Math.ceil(count / pageStep);
    if (pageNumAll == 1) {
        divPage.innerHTML = '';
        return;
    }
    var s = '';
    if (pageNum > 1) {
        s += this.getLink(fnGo, pageNum - 1, pageNum, '<i><&nbsp;</i>上一页');
    } else {
        s += '<span class="sy"><i><&nbsp;</i>上一页</span> ';
    }
    if (pageNum < pageNumAll) {
        s += this.getLink(fnGo, pageNum + 1, pageNum, '下一页<i>&nbsp;></i>');
    } else {
        s += '<span class="xy">下一页<i>&nbsp;></i></span> ';
    }
    var divPage = document.getElementById(el);
    divPage.innerHTML = s;
}