//幻灯片
$(document).ready(function() {
    $(".spotlightBanner li").hover(function() {
        var h = $(this).index();
        a(h);
        c()
    },
    function() {
        d()
    });
    var f;
    $(".arrowUp").live("click",
    function() {
        f = true;
        var h = $(".spotlightBanner li.selected").index();
        c();
        if (h == 0) {
            a(e - 1)
        } else {
            a(h - 1)
        }
        $(this).die("mouseleave").live("mouseleave",
        function() {
            f = false;
            $(this).die("mouseleave");
            d()
        });
        return false
    });
    $(".arrowDown").live("click",
    function() {
        var h = $(".spotlightBanner li.selected").index();
        c();
        if (h >= e - 1) {
            a(0)
        } else {
            a(h + 1)
        }
        $(this).die("mouseleave").live("mouseleave",
        function() {
            $(this).die("mouseleave");
            d()
        });
        return false
    });
    var g;
    d();
    var e = $(".spotlightBanner li").length;
    var b = ($(".track").height() - $(".trackBar").height()) / (e - 1);
    function d() {
        var h = $(".spotlightBanner li.selected").index();
        g = setInterval(function() {
            h += 1;
            if (h >= e) {
                h = 0
            }
            a(h)
        },
        4000)
    }
    function a(h) {
        if (h % 4 == 0) {
            $(".spotlightBanner").scrollTo("li:eq(" + h + ")", 200)
        } else {
            if (f && h % 4 == 3) {
                $(".spotlightBanner").scrollTo("li:eq(" + (h - 3) + ")", 200)
            }
        }
        $(".spotlightBanner li").removeClass("selected").eq(h).addClass("selected");
        $(".spotlight li").fadeOut().eq(h).fadeIn();
        $(".trackBar").css("top", h * b)
    }
    function c() {
        clearInterval(g);
        g = null
    }
});
var swfobject = function() {
    var aq = "undefined",
    aD = "object",
    ab = "Shockwave Flash",
    X = "ShockwaveFlash.ShockwaveFlash",
    aE = "application/x-shockwave-flash",
    ac = "SWFObjectExprInst",
    ax = "onreadystatechange",
    af = window,
    aL = document,
    aB = navigator,
    aa = false,
    Z = [aN],
    aG = [],
    ag = [],
    al = [],
    aJ,
    ad,
    ap,
    at,
    ak = false,
    aU = false,
    aH,
    an,
    aI = true,
    ah = function() {
        var a = typeof aL.getElementById != aq && typeof aL.getElementsByTagName != aq && typeof aL.createElement != aq,
        e = aB.userAgent.toLowerCase(),
        c = aB.platform.toLowerCase(),
        h = c ? /win/.test(c) : /win/.test(e),
        j = c ? /mac/.test(c) : /mac/.test(e),
        g = /webkit/.test(e) ? parseFloat(e.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : false,
        d = !+"\v1",
        f = [0, 0, 0],
        k = null;
        if (typeof aB.plugins != aq && typeof aB.plugins[ab] == aD) {
            k = aB.plugins[ab].description;
            if (k && !(typeof aB.mimeTypes != aq && aB.mimeTypes[aE] && !aB.mimeTypes[aE].enabledPlugin)) {
                aa = true;
                d = false;
                k = k.replace(/^.*\s+(\S+\s+\S+$)/, "$1");
                f[0] = parseInt(k.replace(/^(.*)\..*$/, "$1"), 10);
                f[1] = parseInt(k.replace(/^.*\.(.*)\s.*$/, "$1"), 10);
                f[2] = /[a-zA-Z]/.test(k) ? parseInt(k.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0
            }
        } else {
            if (typeof af.ActiveXObject != aq) {
                try {
                    var i = new ActiveXObject(X);
                    if (i) {
                        k = i.GetVariable("$version");
                        if (k) {
                            d = true;
                            k = k.split(" ")[1].split(",");
                            f = [parseInt(k[0], 10), parseInt(k[1], 10), parseInt(k[2], 10)]
                        }
                    }
                } catch(b) {}
            }
        }
        return {
            w3: a,
            pv: f,
            wk: g,
            ie: d,
            win: h,
            mac: j
        }
    } (),
    aK = function() {
        if (!ah.w3) {
            return
        }
        if ((typeof aL.readyState != aq && aL.readyState == "complete") || (typeof aL.readyState == aq && (aL.getElementsByTagName("body")[0] || aL.body))) {
            aP()
        }
        if (!ak) {
            if (typeof aL.addEventListener != aq) {
                aL.addEventListener("DOMContentLoaded", aP, false)
            }
            if (ah.ie && ah.win) {
                aL.attachEvent(ax,
                function() {
                    if (aL.readyState == "complete") {
                        aL.detachEvent(ax, arguments.callee);
                        aP()
                    }
                });
                if (af == top) { (function() {
                        if (ak) {
                            return
                        }
                        try {
                            aL.documentElement.doScroll("left")
                        } catch(a) {
                            setTimeout(arguments.callee, 0);
                            return
                        }
                        aP()
                    })()
                }
            }
            if (ah.wk) { (function() {
                    if (ak) {
                        return
                    }
                    if (!/loaded|complete/.test(aL.readyState)) {
                        setTimeout(arguments.callee, 0);
                        return
                    }
                    aP()
                })()
            }
            aC(aP)
        }
    } ();
    function aP() {
        if (ak) {
            return
        }
        try {
            var b = aL.getElementsByTagName("body")[0].appendChild(ar("span"));
            b.parentNode.removeChild(b)
        } catch(a) {
            return
        }
        ak = true;
        var d = Z.length;
        for (var c = 0; c < d; c++) {
            Z[c]()
        }
    }
    function aj(a) {
        if (ak) {
            a()
        } else {
            Z[Z.length] = a
        }
    }
    function aC(a) {
        if (typeof af.addEventListener != aq) {
            af.addEventListener("load", a, false)
        } else {
            if (typeof aL.addEventListener != aq) {
                aL.addEventListener("load", a, false)
            } else {
                if (typeof af.attachEvent != aq) {
                    aM(af, "onload", a)
                } else {
                    if (typeof af.onload == "function") {
                        var b = af.onload;
                        af.onload = function() {
                            b();
                            a()
                        }
                    } else {
                        af.onload = a
                    }
                }
            }
        }
    }
    function aN() {
        if (aa) {
            Y()
        } else {
            am()
        }
    }
    function Y() {
        var d = aL.getElementsByTagName("body")[0];
        var b = ar(aD);
        b.setAttribute("type", aE);
        var a = d.appendChild(b);
        if (a) {
            var c = 0; (function() {
                if (typeof a.GetVariable != aq) {
                    var e = a.GetVariable("$version");
                    if (e) {
                        e = e.split(" ")[1].split(",");
                        ah.pv = [parseInt(e[0], 10), parseInt(e[1], 10), parseInt(e[2], 10)]
                    }
                } else {
                    if (c < 10) {
                        c++;
                        setTimeout(arguments.callee, 10);
                        return
                    }
                }
                d.removeChild(b);
                a = null;
                am()
            })()
        } else {
            am()
        }
    }
    function am() {
        var g = aG.length;
        if (g > 0) {
            for (var h = 0; h < g; h++) {
                var c = aG[h].id;
                var l = aG[h].callbackFn;
                var a = {
                    success: false,
                    id: c
                };
                if (ah.pv[0] > 0) {
                    var i = aS(c);
                    if (i) {
                        if (ao(aG[h].swfVersion) && !(ah.wk && ah.wk < 312)) {
                            ay(c, true);
                            if (l) {
                                a.success = true;
                                a.ref = av(c);
                                l(a)
                            }
                        } else {
                            if (aG[h].expressInstall && au()) {
                                var e = {};
                                e.data = aG[h].expressInstall;
                                e.width = i.getAttribute("width") || "0";
                                e.height = i.getAttribute("height") || "0";
                                if (i.getAttribute("class")) {
                                    e.styleclass = i.getAttribute("class")
                                }
                                if (i.getAttribute("align")) {
                                    e.align = i.getAttribute("align")
                                }
                                var f = {};
                                var d = i.getElementsByTagName("param");
                                var k = d.length;
                                for (var j = 0; j < k; j++) {
                                    if (d[j].getAttribute("name").toLowerCase() != "movie") {
                                        f[d[j].getAttribute("name")] = d[j].getAttribute("value")
                                    }
                                }
                                ae(e, f, c, l)
                            } else {
                                aF(i);
                                if (l) {
                                    l(a)
                                }
                            }
                        }
                    }
                } else {
                    ay(c, true);
                    if (l) {
                        var b = av(c);
                        if (b && typeof b.SetVariable != aq) {
                            a.success = true;
                            a.ref = b
                        }
                        l(a)
                    }
                }
            }
        }
    }
    function av(b) {
        var d = null;
        var c = aS(b);
        if (c && c.nodeName == "OBJECT") {
            if (typeof c.SetVariable != aq) {
                d = c
            } else {
                var a = c.getElementsByTagName(aD)[0];
                if (a) {
                    d = a
                }
            }
        }
        return d
    }
    function au() {
        return ! aU && ao("6.0.65") && (ah.win || ah.mac) && !(ah.wk && ah.wk < 312)
    }
    function ae(f, d, h, e) {
        aU = true;
        ap = e || null;
        at = {
            success: false,
            id: h
        };
        var a = aS(h);
        if (a) {
            if (a.nodeName == "OBJECT") {
                aJ = aO(a);
                ad = null
            } else {
                aJ = a;
                ad = h
            }
            f.id = ac;
            if (typeof f.width == aq || (!/%$/.test(f.width) && parseInt(f.width, 10) < 310)) {
                f.width = "310"
            }
            if (typeof f.height == aq || (!/%$/.test(f.height) && parseInt(f.height, 10) < 137)) {
                f.height = "137"
            }
            aL.title = aL.title.slice(0, 47) + " - Flash Player Installation";
            var b = ah.ie && ah.win ? "ActiveX": "PlugIn",
            c = "MMredirectURL=" + af.location.toString().replace(/&/g, "%26") + "&MMplayerType=" + b + "&MMdoctitle=" + aL.title;
            if (typeof d.flashvars != aq) {
                d.flashvars += "&" + c
            } else {
                d.flashvars = c
            }
            if (ah.ie && ah.win && a.readyState != 4) {
                var g = ar("div");
                h += "SWFObjectNew";
                g.setAttribute("id", h);
                a.parentNode.insertBefore(g, a);
                a.style.display = "none"; (function() {
                    if (a.readyState == 4) {
                        a.parentNode.removeChild(a)
                    } else {
                        setTimeout(arguments.callee, 10)
                    }
                })()
            }
            aA(f, d, h)
        }
    }
    function aF(a) {
        if (ah.ie && ah.win && a.readyState != 4) {
            var b = ar("div");
            a.parentNode.insertBefore(b, a);
            b.parentNode.replaceChild(aO(a), b);
            a.style.display = "none"; (function() {
                if (a.readyState == 4) {
                    a.parentNode.removeChild(a)
                } else {
                    setTimeout(arguments.callee, 10)
                }
            })()
        } else {
            a.parentNode.replaceChild(aO(a), a)
        }
    }
    function aO(b) {
        var d = ar("div");
        if (ah.win && ah.ie) {
            d.innerHTML = b.innerHTML
        } else {
            var e = b.getElementsByTagName(aD)[0];
            if (e) {
                var a = e.childNodes;
                if (a) {
                    var f = a.length;
                    for (var c = 0; c < f; c++) {
                        if (! (a[c].nodeType == 1 && a[c].nodeName == "PARAM") && !(a[c].nodeType == 8)) {
                            d.appendChild(a[c].cloneNode(true))
                        }
                    }
                }
            }
        }
        return d
    }
    function aA(e, g, c) {
        var d, a = aS(c);
        if (ah.wk && ah.wk < 312) {
            return d
        }
        if (a) {
            if (typeof e.id == aq) {
                e.id = c
            }
            if (ah.ie && ah.win) {
                var f = "";
                for (var i in e) {
                    if (e[i] != Object.prototype[i]) {
                        if (i.toLowerCase() == "data") {
                            g.movie = e[i]
                        } else {
                            if (i.toLowerCase() == "styleclass") {
                                f += ' class="' + e[i] + '"'
                            } else {
                                if (i.toLowerCase() != "classid") {
                                    f += " " + i + '="' + e[i] + '"'
                                }
                            }
                        }
                    }
                }
                var h = "";
                for (var j in g) {
                    if (g[j] != Object.prototype[j]) {
                        h += '<param name="' + j + '" value="' + g[j] + '" />'
                    }
                }
                a.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + f + ">" + h + "</object>";
                ag[ag.length] = e.id;
                d = aS(e.id)
            } else {
                var b = ar(aD);
                b.setAttribute("type", aE);
                for (var k in e) {
                    if (e[k] != Object.prototype[k]) {
                        if (k.toLowerCase() == "styleclass") {
                            b.setAttribute("class", e[k])
                        } else {
                            if (k.toLowerCase() != "classid") {
                                b.setAttribute(k, e[k])
                            }
                        }
                    }
                }
                for (var l in g) {
                    if (g[l] != Object.prototype[l] && l.toLowerCase() != "movie") {
                        aQ(b, l, g[l])
                    }
                }
                a.parentNode.replaceChild(b, a);
                d = b
            }
        }
        return d
    }
    function aQ(b, d, c) {
        var a = ar("param");
        a.setAttribute("name", d);
        a.setAttribute("value", c);
        b.appendChild(a)
    }
    function aw(a) {
        var b = aS(a);
        if (b && b.nodeName == "OBJECT") {
            if (ah.ie && ah.win) {
                b.style.display = "none"; (function() {
                    if (b.readyState == 4) {
                        aT(a)
                    } else {
                        setTimeout(arguments.callee, 10)
                    }
                })()
            } else {
                b.parentNode.removeChild(b)
            }
        }
    }
    function aT(a) {
        var b = aS(a);
        if (b) {
            for (var c in b) {
                if (typeof b[c] == "function") {
                    b[c] = null
                }
            }
            b.parentNode.removeChild(b)
        }
    }
    function aS(a) {
        var c = null;
        try {
            c = aL.getElementById(a)
        } catch(b) {}
        return c
    }
    function ar(a) {
        return aL.createElement(a)
    }
    function aM(a, c, b) {
        a.attachEvent(c, b);
        al[al.length] = [a, c, b]
    }
    function ao(a) {
        var b = ah.pv,
        c = a.split(".");
        c[0] = parseInt(c[0], 10);
        c[1] = parseInt(c[1], 10) || 0;
        c[2] = parseInt(c[2], 10) || 0;
        return (b[0] > c[0] || (b[0] == c[0] && b[1] > c[1]) || (b[0] == c[0] && b[1] == c[1] && b[2] >= c[2])) ? true: false
    }
    function az(b, f, a, c) {
        if (ah.ie && ah.mac) {
            return
        }
        var e = aL.getElementsByTagName("head")[0];
        if (!e) {
            return
        }
        var g = (a && typeof a == "string") ? a: "screen";
        if (c) {
            aH = null;
            an = null
        }
        if (!aH || an != g) {
            var d = ar("style");
            d.setAttribute("type", "text/css");
            d.setAttribute("media", g);
            aH = e.appendChild(d);
            if (ah.ie && ah.win && typeof aL.styleSheets != aq && aL.styleSheets.length > 0) {
                aH = aL.styleSheets[aL.styleSheets.length - 1]
            }
            an = g
        }
        if (ah.ie && ah.win) {
            if (aH && typeof aH.addRule == aD) {
                aH.addRule(b, f)
            }
        } else {
            if (aH && typeof aL.createTextNode != aq) {
                aH.appendChild(aL.createTextNode(b + " {" + f + "}"))
            }
        }
    }
    function ay(a, c) {
        if (!aI) {
            return
        }
        var b = c ? "visible": "hidden";
        if (ak && aS(a)) {
            aS(a).style.visibility = b
        } else {
            az("#" + a, "visibility:" + b)
        }
    }
    function ai(b) {
        var a = /[\\\"<>\.;]/;
        var c = a.exec(b) != null;
        return c && typeof encodeURIComponent != aq ? encodeURIComponent(b) : b
    }
    var aR = function() {
        if (ah.ie && ah.win) {
            window.attachEvent("onunload",
            function() {
                var a = al.length;
                for (var b = 0; b < a; b++) {
                    al[b][0].detachEvent(al[b][1], al[b][2])
                }
                var d = ag.length;
                for (var c = 0; c < d; c++) {
                    aw(ag[c])
                }
                for (var e in ah) {
                    ah[e] = null
                }
                ah = null;
                for (var f in swfobject) {
                    swfobject[f] = null
                }
                swfobject = null
            })
        }
    } ();
    return {
        registerObject: function(a, e, c, b) {
            if (ah.w3 && a && e) {
                var d = {};
                d.id = a;
                d.swfVersion = e;
                d.expressInstall = c;
                d.callbackFn = b;
                aG[aG.length] = d;
                ay(a, false)
            } else {
                if (b) {
                    b({
                        success: false,
                        id: a
                    })
                }
            }
        },
        getObjectById: function(a) {
            if (ah.w3) {
                return av(a)
            }
        },
        embedSWF: function(k, e, h, f, c, a, b, i, g, j) {
            var d = {
                success: false,
                id: e
            };
            if (ah.w3 && !(ah.wk && ah.wk < 312) && k && e && h && f && c) {
                ay(e, false);
                aj(function() {
                    h += "";
                    f += "";
                    var q = {};
                    if (g && typeof g === aD) {
                        for (var o in g) {
                            q[o] = g[o]
                        }
                    }
                    q.data = k;
                    q.width = h;
                    q.height = f;
                    var n = {};
                    if (i && typeof i === aD) {
                        for (var p in i) {
                            n[p] = i[p]
                        }
                    }
                    if (b && typeof b === aD) {
                        for (var l in b) {
                            if (typeof n.flashvars != aq) {
                                n.flashvars += "&" + l + "=" + b[l]
                            } else {
                                n.flashvars = l + "=" + b[l]
                            }
                        }
                    }
                    if (ao(c)) {
                        var m = aA(q, n, e);
                        if (q.id == e) {
                            ay(e, true)
                        }
                        d.success = true;
                        d.ref = m
                    } else {
                        if (a && au()) {
                            q.data = a;
                            ae(q, n, e, j);
                            return
                        } else {
                            ay(e, true)
                        }
                    }
                    if (j) {
                        j(d)
                    }
                })
            } else {
                if (j) {
                    j(d)
                }
            }
        },
        switchOffAutoHideShow: function() {
            aI = false
        },
        ua: ah,
        getFlashPlayerVersion: function() {
            return {
                major: ah.pv[0],
                minor: ah.pv[1],
                release: ah.pv[2]
            }
        },
        hasFlashPlayerVersion: ao,
        createSWF: function(a, b, c) {
            if (ah.w3) {
                return aA(a, b, c)
            } else {
                return undefined
            }
        },
        showExpressInstall: function(b, a, d, c) {
            if (ah.w3 && au()) {
                ae(b, a, d, c)
            }
        },
        removeSWF: function(a) {
            if (ah.w3) {
                aw(a)
            }
        },
        createCSS: function(b, a, c, d) {
            if (ah.w3) {
                az(b, a, c, d)
            }
        },
        addDomLoadEvent: aj,
        addLoadEvent: aC,
        getQueryParamValue: function(b) {
            var a = aL.location.search || aL.location.hash;
            if (a) {
                if (/\?/.test(a)) {
                    a = a.split("?")[1]
                }
                if (b == null) {
                    return ai(a)
                }
                var c = a.split("&");
                for (var d = 0; d < c.length; d++) {
                    if (c[d].substring(0, c[d].indexOf("=")) == b) {
                        return ai(c[d].substring((c[d].indexOf("=") + 1)))
                    }
                }
            }
            return ""
        },
        expressInstallCallback: function() {
            if (aU) {
                var a = aS(ac);
                if (a && aJ) {
                    a.parentNode.replaceChild(aJ, a);
                    if (ad) {
                        ay(ad, true);
                        if (ah.ie && ah.win) {
                            aJ.style.display = "block"
                        }
                    }
                    if (ap) {
                        ap(at)
                    }
                }
                aU = false
            }
        }
    }
} (); (function(b) {
    var a = function(m, s) {
        var j = b.extend({},
        b.fn.nivoSlider.defaults, s);
        var p = {
            currentSlide: 0,
            currentImage: "",
            totalSlides: 0,
            randAnim: "",
            running: false,
            paused: false,
            stop: false
        };
        var d = b(m);
        d.data("nivo:vars", p);
        d.css("position", "relative");
        d.addClass("nivoSlider");
        var e = d.children();
        e.each(function() {
            var v = b(this);
            var u = "";
            if (!v.is("img")) {
                if (v.is("a")) {
                    v.addClass("nivo-imageLink");
                    u = v
                }
                v = v.find("img:first")
            }
            var t = v.width();
            if (t == 0) {
                t = v.attr("width")
            }
            var i = v.height();
            if (i == 0) {
                i = v.attr("height")
            }
            if (t > d.width()) {
                d.width(t)
            }
            if (i > d.height()) {
                d.height(i)
            }
            if (u != "") {
                u.css("display", "none")
            }
            v.css("display", "none");
            p.totalSlides++
        });
        if (j.startSlide > 0) {
            if (j.startSlide >= p.totalSlides) {
                j.startSlide = p.totalSlides - 1
            }
            p.currentSlide = j.startSlide
        }
        if (b(e[p.currentSlide]).is("img")) {
            p.currentImage = b(e[p.currentSlide])
        } else {
            p.currentImage = b(e[p.currentSlide]).find("img:first")
        }
        if (b(e[p.currentSlide]).is("a")) {
            b(e[p.currentSlide]).css("display", "block")
        }
        d.css("background", 'url("' + p.currentImage.attr("src") + '") no-repeat');
        d.append(b('<div class="nivo-caption"><p></p></div>').css({
            display: "none"
        }));
        var q = function(i) {
            var u = b(".nivo-caption", d);
            if (p.currentImage.attr("title") != "" && p.currentImage.attr("title") != undefined) {
                var t = p.currentImage.attr("title");
                if (t.substr(0, 1) == "#") {
                    t = b(t).html()
                }
                if (u.css("display") == "block") {
                    u.find("p").fadeOut(i.animSpeed,
                    function() {
                        b(this).html(t);
                        b(this).fadeIn(i.animSpeed)
                    })
                } else {
                    u.find("p").html(t)
                }
                u.fadeIn(i.animSpeed)
            } else {
                u.fadeOut(i.animSpeed)
            }
        };
        q(j);
        var c = 0;
        if (!j.manualAdvance && e.length > 1) {
            c = setInterval(function() {
                r(d, e, j, false)
            },
            j.pauseTime)
        }
        if (j.directionNav) {
            d.append('<div class="nivo-directionNav"><a class="nivo-prevNav">' + j.prevText + '</a><a class="nivo-nextNav">' + j.nextText + "</a></div>");
            if (j.directionNavHide) {
                b(".nivo-directionNav", d).hide();
                d.hover(function() {
                    b(".nivo-directionNav", d).show()
                },
                function() {
                    b(".nivo-directionNav", d).hide()
                })
            }
            b("a.nivo-prevNav", d).live("click",
            function() {
                if (p.running) {
                    return false
                }
                clearInterval(c);
                c = "";
                p.currentSlide -= 2;
                r(d, e, j, "prev")
            });
            b("a.nivo-nextNav", d).live("click",
            function() {
                if (p.running) {
                    return false
                }
                clearInterval(c);
                c = "";
                r(d, e, j, "next")
            })
        }
        if (j.controlNav) {
            var n = b('<div class="nivo-controlNav"></div>');
            d.append(n);
            for (var l = 0; l < e.length; l++) {
                if (j.controlNavThumbs) {
                    var f = e.eq(l);
                    if (!f.is("img")) {
                        f = f.find("img:first")
                    }
                    if (j.controlNavThumbsFromRel) {
                        n.append('<a class="nivo-control" rel="' + l + '"><img src="' + f.attr("rel") + '" alt="" /></a>')
                    } else {
                        n.append('<a class="nivo-control" rel="' + l + '"><img src="' + f.attr("src").replace(j.controlNavThumbsSearch, j.controlNavThumbsReplace) + '" alt="" /></a>')
                    }
                } else {
                    n.append('<a class="nivo-control" rel="' + l + '">' + (l + 1) + "</a>")
                }
            }
            b(".nivo-controlNav a:eq(" + p.currentSlide + ")", d).addClass("active");
            b(".nivo-controlNav a", d).live("click",
            function() {
                if (p.running) {
                    return false
                }
                if (b(this).hasClass("active")) {
                    return false
                }
                clearInterval(c);
                c = "";
                d.css("background", 'url("' + p.currentImage.attr("src") + '") no-repeat');
                p.currentSlide = b(this).attr("rel") - 1;
                r(d, e, j, "control")
            })
        }
        if (j.keyboardNav) {
            b(window).keypress(function(i) {
                if (i.keyCode == "37") {
                    if (p.running) {
                        return false
                    }
                    clearInterval(c);
                    c = "";
                    p.currentSlide -= 2;
                    r(d, e, j, "prev")
                }
                if (i.keyCode == "39") {
                    if (p.running) {
                        return false
                    }
                    clearInterval(c);
                    c = "";
                    r(d, e, j, "next")
                }
            })
        }
        if (j.pauseOnHover) {
            d.hover(function() {
                p.paused = true;
                clearInterval(c);
                c = ""
            },
            function() {
                p.paused = false;
                if (c == "" && !j.manualAdvance) {
                    c = setInterval(function() {
                        r(d, e, j, false)
                    },
                    j.pauseTime)
                }
            })
        }
        d.bind("nivo:animFinished",
        function() {
            p.running = false;
            b(e).each(function() {
                if (b(this).is("a")) {
                    b(this).css("display", "none")
                }
            });
            if (b(e[p.currentSlide]).is("a")) {
                b(e[p.currentSlide]).css("display", "block")
            }
            if (c == "" && !p.paused && !j.manualAdvance) {
                c = setInterval(function() {
                    r(d, e, j, false)
                },
                j.pauseTime)
            }
            j.afterChange.call(this)
        });
        var g = function(v, u, x) {
            for (var t = 0; t < u.slices; t++) {
                var w = Math.round(v.width() / u.slices);
                if (t == u.slices - 1) {
                    v.append(b('<div class="nivo-slice"></div>').css({
                        left: (w * t) + "px",
                        width: (v.width() - (w * t)) + "px",
                        height: "0px",
                        opacity: "0",
                        background: 'url("' + x.currentImage.attr("src") + '") no-repeat -' + ((w + (t * w)) - w) + "px 0%"
                    }))
                } else {
                    v.append(b('<div class="nivo-slice"></div>').css({
                        left: (w * t) + "px",
                        width: w + "px",
                        height: "0px",
                        opacity: "0",
                        background: 'url("' + x.currentImage.attr("src") + '") no-repeat -' + ((w + (t * w)) - w) + "px 0%"
                    }))
                }
            }
        };
        var h = function(u, i, x) {
            var t = Math.round(u.width() / i.boxCols);
            var y = Math.round(u.height() / i.boxRows);
            for (var v = 0; v < i.boxRows; v++) {
                for (var w = 0; w < i.boxCols; w++) {
                    if (w == i.boxCols - 1) {
                        u.append(b('<div class="nivo-box"></div>').css({
                            opacity: 0,
                            left: (t * w) + "px",
                            top: (y * v) + "px",
                            width: (u.width() - (t * w)) + "px",
                            height: y + "px",
                            background: 'url("' + x.currentImage.attr("src") + '") no-repeat -' + ((t + (w * t)) - t) + "px -" + ((y + (v * y)) - y) + "px"
                        }))
                    } else {
                        u.append(b('<div class="nivo-box"></div>').css({
                            opacity: 0,
                            left: (t * w) + "px",
                            top: (y * v) + "px",
                            width: t + "px",
                            height: y + "px",
                            background: 'url("' + x.currentImage.attr("src") + '") no-repeat -' + ((t + (w * t)) - t) + "px -" + ((y + (v * y)) - y) + "px"
                        }))
                    }
                }
            }
        };
        var r = function(H, G, K, D) {
            var F = H.data("nivo:vars");
            if (F && (F.currentSlide == F.totalSlides - 1)) {
                K.lastSlide.call(this)
            }
            if ((!F || F.stop) && !D) {
                return false
            }
            K.beforeChange.call(this);
            if (!D) {
                H.css("background", 'url("' + F.currentImage.attr("src") + '") no-repeat')
            } else {
                if (D == "prev") {
                    H.css("background", 'url("' + F.currentImage.attr("src") + '") no-repeat')
                }
                if (D == "next") {
                    H.css("background", 'url("' + F.currentImage.attr("src") + '") no-repeat')
                }
            }
            F.currentSlide++;
            if (F.currentSlide == F.totalSlides) {
                F.currentSlide = 0;
                K.slideshowEnd.call(this)
            }
            if (F.currentSlide < 0) {
                F.currentSlide = (F.totalSlides - 1)
            }
            if (b(G[F.currentSlide]).is("img")) {
                F.currentImage = b(G[F.currentSlide])
            } else {
                F.currentImage = b(G[F.currentSlide]).find("img:first")
            }
            if (K.controlNav) {
                b(".nivo-controlNav a", H).removeClass("active");
                b(".nivo-controlNav a:eq(" + F.currentSlide + ")", H).addClass("active")
            }
            q(K);
            b(".nivo-slice", H).remove();
            b(".nivo-box", H).remove();
            if (K.effect == "random") {
                var M = new Array("sliceDownRight", "sliceDownLeft", "sliceUpRight", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse");
                F.randAnim = M[Math.floor(Math.random() * (M.length + 1))];
                if (F.randAnim == undefined) {
                    F.randAnim = "fade"
                }
            }
            if (K.effect.indexOf(",") != -1) {
                var M = K.effect.split(",");
                F.randAnim = M[Math.floor(Math.random() * (M.length))];
                if (F.randAnim == undefined) {
                    F.randAnim = "fade"
                }
            }
            F.running = true;
            if (K.effect == "sliceDown" || K.effect == "sliceDownRight" || F.randAnim == "sliceDownRight" || K.effect == "sliceDownLeft" || F.randAnim == "sliceDownLeft") {
                g(H, K, F);
                var L = 0;
                var I = 0;
                var t = b(".nivo-slice", H);
                if (K.effect == "sliceDownLeft" || F.randAnim == "sliceDownLeft") {
                    t = b(".nivo-slice", H)._reverse()
                }
                t.each(function() {
                    var i = b(this);
                    i.css({
                        top: "0px"
                    });
                    if (I == K.slices - 1) {
                        setTimeout(function() {
                            i.animate({
                                height: "100%",
                                opacity: "1.0"
                            },
                            K.animSpeed, "",
                            function() {
                                H.trigger("nivo:animFinished")
                            })
                        },


                        (100 + L))
                    } else {
                        setTimeout(function() {
                            i.animate({
                                height: "100%",
                                opacity: "1.0"
                            },
                            K.animSpeed)
                        },
                        (100 + L))
                    }
                    L += 50;
                    I++
                })
            } else {
                if (K.effect == "sliceUp" || K.effect == "sliceUpRight" || F.randAnim == "sliceUpRight" || K.effect == "sliceUpLeft" || F.randAnim == "sliceUpLeft") {
                    g(H, K, F);
                    var L = 0;
                    var I = 0;
                    var t = b(".nivo-slice", H);
                    if (K.effect == "sliceUpLeft" || F.randAnim == "sliceUpLeft") {
                        t = b(".nivo-slice", H)._reverse()
                    }
                    t.each(function() {
                        var i = b(this);
                        i.css({
                            bottom: "0px"
                        });
                        if (I == K.slices - 1) {
                            setTimeout(function() {
                                i.animate({
                                    height: "100%",
                                    opacity: "1.0"
                                },
                                K.animSpeed, "",
                                function() {
                                    H.trigger("nivo:animFinished")
                                })
                            },
                            (100 + L))
                        } else {
                            setTimeout(function() {
                                i.animate({
                                    height: "100%",
                                    opacity: "1.0"
                                },
                                K.animSpeed)
                            },
                            (100 + L))
                        }
                        L += 50;
                        I++
                    })
                } else {
                    if (K.effect == "sliceUpDown" || K.effect == "sliceUpDownRight" || F.randAnim == "sliceUpDown" || K.effect == "sliceUpDownLeft" || F.randAnim == "sliceUpDownLeft") {
                        g(H, K, F);
                        var L = 0;
                        var I = 0;
                        var B = 0;
                        var t = b(".nivo-slice", H);
                        if (K.effect == "sliceUpDownLeft" || F.randAnim == "sliceUpDownLeft") {
                            t = b(".nivo-slice", H)._reverse()
                        }
                        t.each(function() {
                            var i = b(this);
                            if (I == 0) {
                                i.css("top", "0px");
                                I++
                            } else {
                                i.css("bottom", "0px");
                                I = 0
                            }
                            if (B == K.slices - 1) {
                                setTimeout(function() {
                                    i.animate({
                                        height: "100%",
                                        opacity: "1.0"
                                    },
                                    K.animSpeed, "",
                                    function() {
                                        H.trigger("nivo:animFinished")
                                    })
                                },
                                (100 + L))
                            } else {
                                setTimeout(function() {
                                    i.animate({
                                        height: "100%",
                                        opacity: "1.0"
                                    },
                                    K.animSpeed)
                                },
                                (100 + L))
                            }
                            L += 50;
                            B++
                        })
                    } else {
                        if (K.effect == "fold" || F.randAnim == "fold") {
                            g(H, K, F);
                            var L = 0;
                            var I = 0;
                            b(".nivo-slice", H).each(function() {
                                var i = b(this);
                                var v = i.width();
                                i.css({
                                    top: "0px",
                                    height: "100%",
                                    width: "0px"
                                });
                                if (I == K.slices - 1) {
                                    setTimeout(function() {
                                        i.animate({
                                            width: v,
                                            opacity: "1.0"
                                        },
                                        K.animSpeed, "",
                                        function() {
                                            H.trigger("nivo:animFinished")
                                        })
                                    },
                                    (100 + L))
                                } else {
                                    setTimeout(function() {
                                        i.animate({
                                            width: v,
                                            opacity: "1.0"
                                        },
                                        K.animSpeed)
                                    },
                                    (100 + L))
                                }
                                L += 50;
                                I++
                            })
                        } else {
                            if (K.effect == "fade" || F.randAnim == "fade") {
                                g(H, K, F);
                                var z = b(".nivo-slice:first", H);
                                z.css({
                                    height: "100%",
                                    width: H.width() + "px"
                                });
                                z.animate({
                                    opacity: "1.0"
                                },
                                (K.animSpeed * 2), "",
                                function() {
                                    H.trigger("nivo:animFinished")
                                })
                            } else {
                                if (K.effect == "slideInRight" || F.randAnim == "slideInRight") {
                                    g(H, K, F);
                                    var z = b(".nivo-slice:first", H);
                                    z.css({
                                        height: "100%",
                                        width: "0px",
                                        opacity: "1"
                                    });
                                    z.animate({
                                        width: H.width() + "px"
                                    },
                                    (K.animSpeed * 2), "",
                                    function() {
                                        H.trigger("nivo:animFinished")
                                    })
                                } else {
                                    if (K.effect == "slideInLeft" || F.randAnim == "slideInLeft") {
                                        g(H, K, F);
                                        var z = b(".nivo-slice:first", H);
                                        z.css({
                                            height: "100%",
                                            width: "0px",
                                            opacity: "1",
                                            left: "",
                                            right: "0px"
                                        });
                                        z.animate({
                                            width: H.width() + "px"
                                        },
                                        (K.animSpeed * 2), "",
                                        function() {
                                            z.css({
                                                left: "0px",
                                                right: ""
                                            });
                                            H.trigger("nivo:animFinished")
                                        })
                                    } else {
                                        if (K.effect == "boxRandom" || F.randAnim == "boxRandom") {
                                            h(H, K, F);
                                            var J = K.boxCols * K.boxRows;
                                            var I = 0;
                                            var L = 0;
                                            var w = o(b(".nivo-box", H));
                                            w.each(function() {
                                                var i = b(this);
                                                if (I == J - 1) {
                                                    setTimeout(function() {
                                                        i.animate({
                                                            opacity: "1"
                                                        },
                                                        K.animSpeed, "",
                                                        function() {
                                                            H.trigger("nivo:animFinished")
                                                        })
                                                    },
                                                    (100 + L))
                                                } else {
                                                    setTimeout(function() {
                                                        i.animate({
                                                            opacity: "1"
                                                        },
                                                        K.animSpeed)
                                                    },
                                                    (100 + L))
                                                }
                                                L += 20;
                                                I++
                                            })
                                        } else {
                                            if (K.effect == "boxRain" || F.randAnim == "boxRain" || K.effect == "boxRainReverse" || F.randAnim == "boxRainReverse" || K.effect == "boxRainGrow" || F.randAnim == "boxRainGrow" || K.effect == "boxRainGrowReverse" || F.randAnim == "boxRainGrowReverse") {
                                                h(H, K, F);
                                                var J = K.boxCols * K.boxRows;
                                                var I = 0;
                                                var L = 0;
                                                var y = 0;
                                                var E = 0;
                                                var C = new Array();
                                                C[y] = new Array();
                                                var w = b(".nivo-box", H);
                                                if (K.effect == "boxRainReverse" || F.randAnim == "boxRainReverse" || K.effect == "boxRainGrowReverse" || F.randAnim == "boxRainGrowReverse") {
                                                    w = b(".nivo-box", H)._reverse()
                                                }
                                                w.each(function() {
                                                    C[y][E] = b(this);
                                                    E++;
                                                    if (E == K.boxCols) {
                                                        y++;
                                                        E = 0;
                                                        C[y] = new Array()
                                                    }
                                                });
                                                for (var A = 0; A < (K.boxCols * 2); A++) {
                                                    var u = A;
                                                    for (var x = 0; x < K.boxRows; x++) {
                                                        if (u >= 0 && u < K.boxCols) { (function(S, N, R, O, T) {
                                                                var Q = b(C[S][N]);
                                                                var v = Q.width();
                                                                var P = Q.height();
                                                                if (K.effect == "boxRainGrow" || F.randAnim == "boxRainGrow" || K.effect == "boxRainGrowReverse" || F.randAnim == "boxRainGrowReverse") {
                                                                    Q.width(0).height(0)
                                                                }
                                                                if (O == T - 1) {
                                                                    setTimeout(function() {
                                                                        Q.animate({
                                                                            opacity: "1",
                                                                            width: v,
                                                                            height: P
                                                                        },
                                                                        K.animSpeed / 1.3, "",
                                                                        function() {
                                                                            H.trigger("nivo:animFinished")
                                                                        })
                                                                    },
                                                                    (100 + R))
                                                                } else {
                                                                    setTimeout(function() {
                                                                        Q.animate({
                                                                            opacity: "1",
                                                                            width: v,
                                                                            height: P
                                                                        },
                                                                        K.animSpeed / 1.3)
                                                                    },
                                                                    (100 + R))
                                                                }
                                                            })(x, u, L, I, J);
                                                            I++
                                                        }
                                                        u--
                                                    }
                                                    L += 100
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        };
        var o = function(u) {
            for (var v, t, w = u.length; w; v = parseInt(Math.random() * w), t = u[--w], u[w] = u[v], u[v] = t) {}
            return u
        };
        var k = function(i) {
            if (this.console && typeof console.log != "undefined") {
                console.log(i)
            }
        };
        this.stop = function() {
            if (!b(m).data("nivo:vars").stop) {
                b(m).data("nivo:vars").stop = true;
                k("Stop Slider")
            }
        };
        this.start = function() {
            if (b(m).data("nivo:vars").stop) {
                b(m).data("nivo:vars").stop = false;
                k("Start Slider")
            }
        };
        j.afterLoad.call(this);
        return this
    };
    b.fn.nivoSlider = function(c) {
        return this.each(function(e, g) {
            var d = b(this);
            if (d.data("nivoslider")) {
                return d.data("nivoslider")
            }
            var f = new a(this, c);
            d.data("nivoslider", f)
        })
    };
    b.fn.nivoSlider.defaults = {
        effect: "random",
        slices: 15,
        boxCols: 8,
        boxRows: 4,
        animSpeed: 500,
        pauseTime: 3000,
        startSlide: 0,
        directionNav: true,
        directionNavHide: true,
        controlNav: true,
        controlNavThumbs: false,
        controlNavThumbsFromRel: false,
        controlNavThumbsSearch: ".jpg",
        controlNavThumbsReplace: "_thumb.jpg",
        keyboardNav: true,
        pauseOnHover: true,
        manualAdvance: false,
        captionOpacity: 0.8,
        prevText: "Prev",
        nextText: "Next",
        beforeChange: function() {},
        afterChange: function() {},
        slideshowEnd: function() {},
        lastSlide: function() {},
        afterLoad: function() {}
    };
    b.fn._reverse = [].reverse
})(jQuery); (function(c) {
    var a = c.scrollTo = function(d, f, g) {
        c(window).scrollTo(d, f, g)
    };
    a.defaults = {
        axis: "xy",
        duration: parseFloat(c.fn.jquery) >= 1.3 ? 0 : 1
    };
    a.window = function(d) {
        return c(window)._scrollable()
    };
    c.fn._scrollable = function() {
        return this.map(function() {
            var d = this,
            f = !d.nodeName || c.inArray(d.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]) != -1;
            if (!f) {
                return d
            }
            var g = (d.contentWindow || d).document || d.ownerDocument || d;
            return c.browser.safari || g.compatMode == "BackCompat" ? g.body: g.documentElement
        })
    };
    c.fn.scrollTo = function(f, e, d) {
        if (typeof e == "object") {
            d = e;
            e = 0
        }
        if (typeof d == "function") {
            d = {
                onAfter: d
            }
        }
        if (f == "max") {
            f = 9000000000
        }
        d = c.extend({},
        a.defaults, d);
        e = e || d.speed || d.duration;
        d.queue = d.queue && d.axis.length > 1;
        if (d.queue) {
            e /= 2
        }
        d.offset = b(d.offset);
        d.over = b(d.over);
        return this._scrollable().each(function() {
            var n = this,
            l = c(n),
            m = f,
            j,
            k = {},
            h = l.is("html,body");
            switch (typeof m) {
            case "number":
            case "string":
                if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(m)) {
                    m = b(m);
                    break
                }
                m = c(m, this);
            case "object":
                if (m.is || m.style) {
                    j = (m = c(m)).offset()
                }
            }
            c.each(d.axis.split(""),
            function(q, r) {
                var t = r == "x" ? "Left": "Top",
                s = t.toLowerCase(),
                v = "scroll" + t,
                p = n[v],
                g = a.max(n, r);
                if (j) {
                    k[v] = j[s] + (h ? 0 : p - l.offset()[s]);
                    if (d.margin) {
                        k[v] -= parseInt(m.css("margin" + t)) || 0;
                        k[v] -= parseInt(m.css("border" + t + "Width")) || 0
                    }
                    k[v] += d.offset[s] || 0;
                    if (d.over[s]) {
                        k[v] += m[r == "x" ? "width": "height"]() * d.over[s]
                    }
                } else {
                    var u = m[s];
                    k[v] = u.slice && u.slice( - 1) == "%" ? parseFloat(u) / 100 * g: u
                }
                if (/^\d+$/.test(k[v])) {
                    k[v] = k[v] <= 0 ? 0 : Math.min(k[v], g)
                }
                if (!q && d.queue) {
                    if (p != k[v]) {
                        i(d.onAfterFirst)
                    }
                    delete k[v]
                }
            });
            i(d.onAfter);
            function i(g) {
                l.animate(k, e, d.easing, g &&
                function() {
                    g.call(this, f, d)
                })
            }
        }).end()
    };
    a.max = function(g, j) {
        var n = j == "x" ? "Width": "Height",
        k = "scroll" + n;
        if (!c(g).is("html,body")) {
            return g[k] - c(g)[n.toLowerCase()]()
        }
        var o = "client" + n,
        f = g.ownerDocument.documentElement,
        d = g.ownerDocument.body;
        return Math.max(f[k], d[k]) - Math.min(f[o], d[o])
    };
    function b(d) {
        return typeof d == "object" ? d: {
            top: d,
            left: d
        }
    }
})(jQuery); (function(aG) {
    var ay, aq, ap, aD, aj, aA, ai, ax, am, al, au = 0,
    aE = {},
    aw = [],
    av = 0,
    aF = {},
    az = [],
    ag = null,
    ao = new Image,
    ae = /\.(jpg|gif|png|bmp|jpeg)(.*)?$/i,
    k = /[^\.]\.(swf)\s*$/i,
    ad,
    ac = 1,
    an = 0,
    ar = "",
    at,
    aB,
    aC = false,
    ak = aG.extend(aG("<div/>")[0], {
        prop: 0
    }),
    ab = aG.browser.msie && aG.browser.version < 7 && !window.XMLHttpRequest,
    aa = function() {
        aq.hide();
        ao.onerror = ao.onload = null;
        ag && ag.abort();
        ay.empty()
    },
    R = function() {
        if (false === aE.onError(aw, au, aE)) {
            aq.hide();
            aC = false
        } else {
            aE.titleShow = false;
            aE.width = "auto";
            aE.height = "auto";
            ay.html('<p id="fancybox-error">The requested content cannot be loaded.<br />Please try again later.</p>');
            ah()
        }
    },
    af = function() {
        var d = aw[au],
        j,
        f,
        e,
        i,
        h,
        b;
        aa();
        aE = aG.extend({},
        aG.fn.fancybox.defaults, typeof aG(d).data("fancybox") == "undefined" ? aE: aG(d).data("fancybox"));
        b = aE.onStart(aw, au, aE);
        if (b === false) {
            aC = false
        } else {
            if (typeof b == "object") {
                aE = aG.extend(aE, b)
            }
            e = aE.title || (d.nodeName ? aG(d).attr("title") : d.title) || "";
            if (d.nodeName && !aE.orig) {
                aE.orig = aG(d).children("img:first").length ? aG(d).children("img:first") : aG(d)
            }
            if (e === "" && aE.orig && aE.titleFromAlt) {
                e = aE.orig.attr("alt")
            }
            j = aE.href || (d.nodeName ? aG(d).attr("href") : d.href) || null;
            if (/^(?:javascript)/i.test(j) || j == "#") {
                j = null
            }
            if (aE.type) {
                f = aE.type;
                if (!j) {
                    j = aE.content
                }
            } else {
                if (aE.content) {
                    f = "html"
                } else {
                    if (j) {
                        f = j.match(ae) ? "image": j.match(k) ? "swf": aG(d).hasClass("iframe") ? "iframe": j.indexOf("#") === 0 ? "inline": "ajax"
                    }
                }
            }
            if (f) {
                if (f == "inline") {
                    d = j.substr(j.indexOf("#"));
                    f = aG(d).length > 0 ? "inline": "ajax"
                }
                aE.type = f;
                aE.href = j;
                aE.title = e;
                if (aE.autoDimensions) {
                    if (aE.type == "html" || aE.type == "inline" || aE.type == "ajax") {
                        aE.width = "auto";
                        aE.height = "auto"
                    } else {
                        aE.autoDimensions = false
                    }
                }
                if (aE.modal) {
                    aE.overlayShow = true;
                    aE.hideOnOverlayClick = false;
                    aE.hideOnContentClick = false;
                    aE.enableEscapeButton = false;
                    aE.showCloseButton = false
                }
                aE.padding = parseInt(aE.padding, 10);
                aE.margin = parseInt(aE.margin, 10);
                ay.css("padding", aE.padding + aE.margin);
                aG(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change",
                function() {
                    aG(this).replaceWith(aA.children())
                });
                switch (f) {
                case "html":
                    ay.html(aE.content);
                    ah();
                    break;
                case "inline":
                    if (aG(d).parent().is("#fancybox-content") === true) {
                        aC = false;
                        break
                    }
                    aG('<div class="fancybox-inline-tmp" />').hide().insertBefore(aG(d)).bind("fancybox-cleanup",
                    function() {
                        aG(this).replaceWith(aA.children())
                    }).bind("fancybox-cancel",
                    function() {
                        aG(this).replaceWith(ay.children())
                    });
                    aG(d).appendTo(ay);
                    ah();
                    break;
                case "image":
                    aC = false;
                    aG.fancybox.showActivity();
                    ao = new Image;
                    ao.onerror = function() {
                        R()
                    };
                    ao.onload = function() {
                        aC = true;
                        ao.onerror = ao.onload = null;
                        aE.width = ao.width;
                        aE.height = ao.height;
                        aG("<img />").attr({
                            id: "fancybox-img",
                            src: ao.src,
                            alt: aE.title
                        }).appendTo(ay);
                        P()
                    };
                    ao.src = j;
                    break;
                case "swf":
                    aE.scrolling = "no";
                    i = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + aE.width + '" height="' + aE.height + '"><param name="movie" value="' + j + '"></param>';
                    h = "";
                    aG.each(aE.swf,
                    function(l, m) {
                        i += '<param name="' + l + '" value="' + m + '"></param>';
                        h += " " + l + '="' + m + '"'
                    });
                    i += '<embed src="' + j + '" type="application/x-shockwave-flash" width="' + aE.width + '" height="' + aE.height + '"' + h + "></embed></object>";
                    ay.html(i);
                    ah();
                    break;
                case "ajax":
                    aC = false;
                    aG.fancybox.showActivity();
                    aE.ajax.win = aE.ajax.success;
                    ag = aG.ajax(aG.extend({},
                    aE.ajax, {
                        url: j,
                        data: aE.ajax.data || {},
                        error: function(l) {
                            l.status > 0 && R()
                        },
                        success: function(l, m, n) {
                            if ((typeof n == "object" ? n: ag).status == 200) {
                                if (typeof aE.ajax.win == "function") {
                                    b = aE.ajax.win(j, l, m, n);
                                    if (b === false) {
                                        aq.hide();
                                        return
                                    } else {
                                        if (typeof b == "string" || typeof b == "object") {
                                            l = b
                                        }
                                    }
                                }
                                ay.html(l);
                                ah()
                            }
                        }
                    }));
                    break;
                case "iframe":
                    P()
                }
            } else {
                R()
            }
        }
    },
    ah = function() {
        var b = aE.width,
        d = aE.height;
        b = b.toString().indexOf("%") > -1 ? parseInt((aG(window).width() - aE.margin * 2) * parseFloat(b) / 100, 10) + "px": b == "auto" ? "auto": b + "px";
        d = d.toString().indexOf("%") > -1 ? parseInt((aG(window).height() - aE.margin * 2) * parseFloat(d) / 100, 10) + "px": d == "auto" ? "auto": d + "px";
        ay.wrapInner('<div style="width:' + b + ";height:" + d + ";overflow: " + (aE.scrolling == "no" ? "no": aE.scrolling == "no" ? "scroll": "hidden") + ';position:relative;"></div>');
        aE.width = ay.width();
        aE.height = ay.height();
        P()
    },
    P = function() {
        var b, d;
        aq.hide();
        if (aD.is(":visible") && false === aF.onCleanup(az, av, aF)) {
            aG.event.trigger("fancybox-cancel");
            aC = false
        } else {
            aC = true;
            aG(aA.add(ap)).unbind();
            aG(window).unbind("resize.fb scroll.fb");
            aG(document).unbind("keydown.fb");
            aD.is(":visible") && aF.titlePosition !== "outside" && aD.css("height", aD.height());
            az = aw;
            av = au;
            aF = aE;
            if (aF.overlayShow) {
                ap.css({
                    "background-color": aF.overlayColor,
                    opacity: aF.overlayOpacity,
                    cursor: aF.hideOnOverlayClick ? "pointer": "auto",
                    height: aG(document).height()
                });
                if (!ap.is(":visible")) {
                    ab && aG("select:not(#fancybox-tmp select)").filter(function() {
                        return this.style.visibility !== "hidden"
                    }).css({
                        visibility: "hidden"
                    }).one("fancybox-cleanup",
                    function() {
                        this.style.visibility = "inherit"
                    });
                    ap.show()
                }
            } else {
                ap.hide()
            }
            aB = g();
            ar = aF.title || "";
            an = 0;
            ax.empty().removeAttr("style").removeClass();
            if (aF.titleShow !== false) {
                if (aG.isFunction(aF.titleFormat)) {
                    b = aF.titleFormat(ar, az, av, aF)
                } else {
                    b = ar && ar.length ? aF.titlePosition == "float" ? '<table id="fancybox-title-float-wrap" cellpadding="0" cellspacing="0"><tr><td id="fancybox-title-float-left"></td><td id="fancybox-title-float-main">' + ar + '</td><td id="fancybox-title-float-right"></td></tr></table>': '<div id="fancybox-title-' + aF.titlePosition + '">' + ar + "</div>": false
                }
                ar = b;
                if (! (!ar || ar === "")) {
                    ax.addClass("fancybox-title-" + aF.titlePosition).html(ar).appendTo("body").show();
                    switch (aF.titlePosition) {
                    case "inside":
                        ax.css({
                            width:
                            aB.width - aF.padding * 2,
                            marginLeft: aF.padding,
                            marginRight: aF.padding
                        });
                        an = ax.outerHeight(true);
                        ax.appendTo(aj);
                        aB.height += an;
                        break;
                    case "over":
                        ax.css({
                            marginLeft:
                            aF.padding,
                            width: aB.width - aF.padding * 2,
                            bottom: aF.padding
                        }).appendTo(aj);
                        break;
                    case "float":
                        ax.css("left", parseInt((ax.width() - aB.width - 40) / 2, 10) * -1).appendTo(aD);
                        break;
                    default:
                        ax.css({
                            width:
                            aB.width - aF.padding * 2,
                            paddingLeft: aF.padding,
                            paddingRight: aF.padding
                        }).appendTo(aD)
                    }
                }
            }
            ax.hide();
            if (aD.is(":visible")) {
                aG(ai.add(am).add(al)).hide();
                b = aD.position();
                at = {
                    top: b.top,
                    left: b.left,
                    width: aD.width(),
                    height: aD.height()
                };
                d = at.width == aB.width && at.height == aB.height;
                aA.fadeTo(aF.changeFade, 0.3,
                function() {
                    var e = function() {
                        aA.html(ay.contents()).fadeTo(aF.changeFade, 1, H)
                    };
                    aG.event.trigger("fancybox-change");
                    aA.empty().removeAttr("filter").css({
                        "border-width": aF.padding,
                        width: aB.width - aF.padding * 2,
                        height: aE.autoDimensions ? "auto": aB.height - an - aF.padding * 2
                    });
                    if (d) {
                        e()
                    } else {
                        ak.prop = 0;
                        aG(ak).animate({
                            prop: 1
                        },
                        {
                            duration: aF.changeSpeed,
                            easing: aF.easingChange,
                            step: C,
                            complete: e
                        })
                    }
                })
            } else {
                aD.removeAttr("style");
                aA.css("border-width", aF.padding);
                if (aF.transitionIn == "elastic") {
                    at = w();
                    aA.html(ay.contents());
                    aD.show();
                    if (aF.opacity) {
                        aB.opacity = 0
                    }
                    ak.prop = 0;
                    aG(ak).animate({
                        prop: 1
                    },
                    {
                        duration: aF.speedIn,
                        easing: aF.easingIn,
                        step: C,
                        complete: H
                    })
                } else {
                    aF.titlePosition == "inside" && an > 0 && ax.show();
                    aA.css({
                        width: aB.width - aF.padding * 2,
                        height: aE.autoDimensions ? "auto": aB.height - an - aF.padding * 2
                    }).html(ay.contents());
                    aD.css(aB).fadeIn(aF.transitionIn == "none" ? 0 : aF.speedIn, H)
                }
            }
        }
    },
    c = function() {
        if (aF.enableEscapeButton || aF.enableKeyboardNav) {
            aG(document).bind("keydown.fb",
            function(b) {
                if (b.keyCode == 27 && aF.enableEscapeButton) {
                    b.preventDefault();
                    aG.fancybox.close()
                } else {
                    if ((b.keyCode == 37 || b.keyCode == 39) && aF.enableKeyboardNav && b.target.tagName !== "INPUT" && b.target.tagName !== "TEXTAREA" && b.target.tagName !== "SELECT") {
                        b.preventDefault();
                        aG.fancybox[b.keyCode == 37 ? "prev": "next"]()
                    }
                }
            })
        }
        if (aF.showNavArrows) {
            if (aF.cyclic && az.length > 1 || av !== 0) {
                am.show()
            }
            if (aF.cyclic && az.length > 1 || av != az.length - 1) {
                al.show()
            }
        } else {
            am.hide();
            al.hide()
        }
    },
    H = function() {
        if (!aG.support.opacity) {
            aA.get(0).style.removeAttribute("filter");
            aD.get(0).style.removeAttribute("filter")
        }
        aE.autoDimensions && aA.css("height", "auto");
        aD.css("height", "auto");
        ar && ar.length && ax.show();
        aF.showCloseButton && ai.show();
        c();
        aF.hideOnContentClick && aA.bind("click", aG.fancybox.close);
        aF.hideOnOverlayClick && ap.bind("click", aG.fancybox.close);
        aG(window).bind("resize.fb", aG.fancybox.resize);
        aF.centerOnScroll && aG(window).bind("scroll.fb", aG.fancybox.center);
        if (aF.type == "iframe") {
            aG('<iframe id="fancybox-frame" name="fancybox-frame' + (new Date).getTime() + '" frameborder="0" hspace="0" ' + (aG.browser.msie ? 'allowtransparency="true""': "") + ' scrolling="yes" src="' + aF.href + '"></iframe>').appendTo(aA)
        }
        aD.show();
        aC = false;
        aG.fancybox.center();
        aF.onComplete(az, av, aF);
        var b, d;
        if (az.length - 1 > av) {
            b = az[av + 1].href;
            if (typeof b !== "undefined" && b.match(ae)) {
                d = new Image;
                d.src = b
            }
        }
        if (av > 0) {
            b = az[av - 1].href;
            if (typeof b !== "undefined" && b.match(ae)) {
                d = new Image;
                d.src = b
            }
        }
    },
    C = function(b) {
        var d = {
            width: parseInt(at.width + (aB.width - at.width) * b, 10),
            height: parseInt(at.height + (aB.height - at.height) * b, 10),
            top: parseInt(at.top + (aB.top - at.top) * b, 10),
            left: parseInt(at.left + (aB.left - at.left) * b, 10)
        };
        if (typeof aB.opacity !== "undefined") {
            d.opacity = b < 0.5 ? 0.5 : b
        }
        aD.css(d);
        aA.css({
            width: d.width - aF.padding * 2,
            height: d.height - an * b - aF.padding * 2
        })
    },
    x = function() {
        return [aG(window).width() - aF.margin * 2, aG(window).height() - aF.margin * 2, aG(document).scrollLeft() + aF.margin, aG(document).scrollTop() + aF.margin]
    },
    g = function() {
        var b = x(),
        f = {},
        e = aF.autoScale,
        d = aF.padding * 2;
        f.width = aF.width.toString().indexOf("%") > -1 ? parseInt(b[0] * parseFloat(aF.width) / 100, 10) : aF.width + d;
        f.height = aF.height.toString().indexOf("%") > -1 ? parseInt(b[1] * parseFloat(aF.height) / 100, 10) : aF.height + d;
        if (e && (f.width > b[0] || f.height > b[1])) {
            if (aE.type == "image" || aE.type == "swf") {
                e = aF.width / aF.height;
                if (f.width > b[0]) {
                    f.width = b[0];
                    f.height = parseInt((f.width - d) / e + d, 10)
                }
                if (f.height > b[1]) {
                    f.height = b[1];
                    f.width = parseInt((f.height - d) * e + d, 10)
                }
            } else {
                f.width = Math.min(f.width, b[0]);
                f.height = Math.min(f.height, b[1])
            }
        }
        f.top = parseInt(Math.max(b[3] - 20, b[3] + (b[1] - f.height - 40) * 0.5), 10);
        f.left = parseInt(Math.max(b[2] - 20, b[2] + (b[0] - f.width - 40) * 0.5), 10);
        return f
    },
    w = function() {
        var b = aE.orig ? aG(aE.orig) : false,
        d = {};
        if (b && b.length) {
            d = b.offset();
            d.top += parseInt(b.css("paddingTop"), 10) || 0;
            d.left += parseInt(b.css("paddingLeft"), 10) || 0;
            d.top += parseInt(b.css("border-top-width"), 10) || 0;
            d.left += parseInt(b.css("border-left-width"), 10) || 0;
            d.width = b.width();
            d.height = b.height();
            d = {
                width: d.width + aF.padding * 2,
                height: d.height + aF.padding * 2,
                top: d.top - aF.padding - 20,
                left: d.left - aF.padding - 20
            }
        } else {
            b = x();
            d = {
                width: aF.padding * 2,
                height: aF.padding * 2,
                top: parseInt(b[3] + b[1] * 0.5, 10),
                left: parseInt(b[2] + b[0] * 0.5, 10)
            }
        }
        return d
    },
    a = function() {
        if (aq.is(":visible")) {
            aG("div", aq).css("top", ac * -40 + "px");
            ac = (ac + 1) % 12
        } else {
            clearInterval(ad)
        }
    };
    aG.fn.fancybox = function(b) {
        if (!aG(this).length) {
            return this
        }
        aG(this).data("fancybox", aG.extend({},
        b, aG.metadata ? aG(this).metadata() : {})).unbind("click.fb").bind("click.fb",
        function(d) {
            d.preventDefault();
            if (!aC) {
                aC = true;
                aG(this).blur();
                aw = [];
                au = 0;
                d = aG(this).attr("rel") || "";
                if (!d || d == "" || d === "nofollow") {
                    aw.push(this)
                } else {
                    aw = aG("a[rel=" + d + "], area[rel=" + d + "]");
                    au = aw.index(this)
                }
                af()
            }
        });
        return this
    };
    aG.fancybox = function(b, h) {
        var e;
        if (!aC) {
            aC = true;
            e = typeof h !== "undefined" ? h: {};
            aw = [];
            au = parseInt(e.index, 10) || 0;
            if (aG.isArray(b)) {
                for (var d = 0,
                f = b.length; d < f; d++) {
                    if (typeof b[d] == "object") {
                        aG(b[d]).data("fancybox", aG.extend({},
                        e, b[d]))
                    } else {
                        b[d] = aG({}).data("fancybox", aG.extend({
                            content: b[d]
                        },
                        e))
                    }
                }
                aw = jQuery.merge(aw, b)
            } else {
                if (typeof b == "object") {
                    aG(b).data("fancybox", aG.extend({},
                    e, b))
                } else {
                    b = aG({}).data("fancybox", aG.extend({
                        content: b
                    },
                    e))
                }
                aw.push(b)
            }
            if (au > aw.length || au < 0) {
                au = 0
            }
            af()
        }
    };
    aG.fancybox.showActivity = function() {
        clearInterval(ad);
        aq.show();
        ad = setInterval(a, 66)
    };
    aG.fancybox.hideActivity = function() {
        aq.hide()
    };
    aG.fancybox.next = function() {
        return aG.fancybox.pos(av + 1)
    };
    aG.fancybox.prev = function() {
        return aG.fancybox.pos(av - 1)
    };
    aG.fancybox.pos = function(b) {
        if (!aC) {
            b = parseInt(b);
            aw = az;
            if (b > -1 && b < az.length) {
                au = b;
                af()
            } else {
                if (aF.cyclic && az.length > 1) {
                    au = b >= az.length ? 0 : az.length - 1;
                    af()
                }
            }
        }
    };
    aG.fancybox.cancel = function() {
        if (!aC) {
            aC = true;
            aG.event.trigger("fancybox-cancel");
            aa();
            aE.onCancel(aw, au, aE);
            aC = false
        }
    };
    aG.fancybox.close = function() {
        function b() {
            ap.fadeOut("fast");
            ax.empty().hide();
            aD.hide();
            aG.event.trigger("fancybox-cleanup");
            aA.empty();
            aF.onClosed(az, av, aF);
            az = aE = [];
            av = au = 0;
            aF = aE = {};
            aC = false
        }
        if (! (aC || aD.is(":hidden"))) {
            aC = true;
            if (aF && false === aF.onCleanup(az, av, aF)) {
                aC = false
            } else {
                aa();
                aG(ai.add(am).add(al)).hide();
                aG(aA.add(ap)).unbind();
                aG(window).unbind("resize.fb scroll.fb");
                aG(document).unbind("keydown.fb");
                aA.find("iframe").attr("src", ab && /^https/i.test(window.location.href || "") ? "javascript:void(false)": "about:blank");
                aF.titlePosition !== "inside" && ax.empty();
                aD.stop();
                if (aF.transitionOut == "elastic") {
                    at = w();
                    var d = aD.position();
                    aB = {
                        top: d.top,
                        left: d.left,
                        width: aD.width(),
                        height: aD.height()
                    };
                    if (aF.opacity) {
                        aB.opacity = 1
                    }
                    ax.empty().hide();
                    ak.prop = 1;
                    aG(ak).animate({
                        prop: 0
                    },
                    {
                        duration: aF.speedOut,
                        easing: aF.easingOut,
                        step: C,
                        complete: b
                    })
                } else {
                    aD.fadeOut(aF.transitionOut == "none" ? 0 : aF.speedOut, b)
                }
            }
        }
    };
    aG.fancybox.resize = function() {
        ap.is(":visible") && ap.css("height", aG(document).height());
        aG.fancybox.center(true)
    };
    aG.fancybox.center = function(b) {
        var e, d;
        if (!aC) {
            d = b === true ? 1 : 0;
            e = x(); ! d && (aD.width() > e[0] || aD.height() > e[1]) || aD.stop().animate({
                top: parseInt(Math.max(e[3] - 20, e[3] + (e[1] - aA.height() - 40) * 0.5 - aF.padding)),
                left: parseInt(Math.max(e[2] - 20, e[2] + (e[0] - aA.width() - 40) * 0.5 - aF.padding))
            },
            typeof b == "number" ? b: 200)
        }
    };
    aG.fancybox.init = function() {
        if (!aG("#fancybox-wrap").length) {
            aG("body").append(ay = aG('<div id="fancybox-tmp"></div>'), aq = aG('<div id="fancybox-loading"><div></div></div>'), ap = aG('<div id="fancybox-overlay"></div>'), aD = aG('<div id="fancybox-wrap"></div>'));
            aj = aG('<div id="fancybox-outer"></div>').append('<div class="fancybox-bg" id="fancybox-bg-n"></div><div class="fancybox-bg" id="fancybox-bg-ne"></div><div class="fancybox-bg" id="fancybox-bg-e"></div><div class="fancybox-bg" id="fancybox-bg-se"></div><div class="fancybox-bg" id="fancybox-bg-s"></div><div class="fancybox-bg" id="fancybox-bg-sw"></div><div class="fancybox-bg" id="fancybox-bg-w"></div><div class="fancybox-bg" id="fancybox-bg-nw"></div>').appendTo(aD);
            aj.append(aA = aG('<div id="fancybox-content"></div>'), ai = aG('<a id="fancybox-close"></a>'), ax = aG('<div id="fancybox-title"></div>'), am = aG('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'), al = aG('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>'));
            ai.click(aG.fancybox.close);
            aq.click(aG.fancybox.cancel);
            am.click(function(b) {
                b.preventDefault();
                aG.fancybox.prev()
            });
            al.click(function(b) {
                b.preventDefault();
                aG.fancybox.next()
            });
            aG.fn.mousewheel && aD.bind("mousewheel.fb",
            function(b, d) {
                if (aC) {
                    b.preventDefault()
                } else {
                    if (aG(b.target).get(0).clientHeight == 0 || aG(b.target).get(0).scrollHeight === aG(b.target).get(0).clientHeight) {
                        b.preventDefault();
                        aG.fancybox[d > 0 ? "prev": "next"]()
                    }
                }
            });
            aG.support.opacity || aD.addClass("fancybox-ie");
            if (ab) {
                aq.addClass("fancybox-ie6");
                aD.addClass("fancybox-ie6");
                aG('<iframe style="height:0;" id="fancybox-hide-sel-frame" src="' + (/^https/i.test(window.location.href || "") ? "javascript:void(false)": "about:blank") + '" scrolling="yes" border="0" frameborder="0" tabindex="-1"></iframe>').prependTo(aj)
            }
        }
    };
    aG.fn.fancybox.defaults = {
        padding: 10,
        margin: 40,
        opacity: false,
        modal: false,
        cyclic: false,
        scrolling: "no",
        width: 560,
        height: 340,
        autoScale: true,
        autoDimensions: true,
        centerOnScroll: false,
        ajax: {},
        swf: {
            wmode: "transparent"
        },
        hideOnOverlayClick: true,
        hideOnContentClick: false,
        overlayShow: true,
        overlayOpacity: 0.7,
        overlayColor: "#777",
        titleShow: true,
        titlePosition: "float",
        titleFormat: null,
        titleFromAlt: false,
        transitionIn: "fade",
        transitionOut: "fade",
        speedIn: 300,
        speedOut: 300,
        changeSpeed: 300,
        changeFade: "fast",
        easingIn: "swing",
        easingOut: "swing",
        showCloseButton: true,
        showNavArrows: true,
        enableEscapeButton: true,
        enableKeyboardNav: true,
        onStart: function() {},
        onCancel: function() {},
        onComplete: function() {},
        onCleanup: function() {},
        onClosed: function() {},
        onError: function() {}
    };
    aG(document).ready(function() {
        aG.fancybox.init()
    })
})(jQuery);

$(function(){
	//游戏立即体验按钮
	$(".game .cont .ul_2 li .a_1 ,.game .cont .ul_3 li .a_1").mouseover(function(){
		$(this).find(".bk").show();
		$(this).find(".ann").show();
		});
	$(".game .cont .ul_2 li .a_1,.game .cont .ul_3 li .a_1").mouseout(function(){
		$(this).find(".bk").hide();
		$(this).find(".ann").hide();
		});
	//试玩预告—设置QQ提醒
	$(".trailer .cont .ul_1 .li_2 .state").mouseover(function(){
		$(this).find(".sp_1").hide();
		$(this).find(".sp_2").show();
		});
	$(".trailer .cont .ul_1 .li_2 .state").mouseout(function(){
		$(this).find(".sp_1").show();
		$(this).find(".sp_2").hide();
		});
	})