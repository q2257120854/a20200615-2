function ucShare(a) {
	if (-1 !== window.navigator.userAgent.indexOf("UCBrowser")) {
		var b = function(b) {
				var c = -1 !== window.navigator.userAgent.indexOf("iPhone"),
					d = -1 !== window.navigator.userAgent.indexOf("Android"),
					e = document.getElementById("news_template_04_banner"),
					f = document.getElementById("id_imagebox_0"),
					g = e ? e : f ? f : "";
				if (c) {
					var h = "friend" == b ? "kWeixin" : "kWeixinFriend";
					linkPlus = "friend" == b ? "?&f=weixin_uc_friend" : "?&f=weixin_uc_timeline", ucbrowser.web_share(a.title, a.desc, a.link + linkPlus, h, "", "", g.id)
				} else if (d) {
					var h = "friend" == b ? "WechatFriends" : "WechatTimeline";
					linkPlus = "friend" == b ? "?&f=weixin_uc_friend" : "?&f=weixin_uc_timeline", getPos = {
						getTop: function(a) {
							var b = a.offsetTop;
							return null != a.offsetParent && (b += getPos.getTop(a.offsetParent)), b
						},
						getLeft: function(a) {
							var b = a.offsetLeft;
							return null != a.offsetParent && (b += getPos.getLeft(a.offsetParent)), b
						},
						getNodeInfoById: function(a) {
							var b = document.getElementById(a);
							if (b) {
								var c = [getPos.getLeft(b), getPos.getTop(b), b.offsetWidth, b.offsetHeight];
								return c
							}
							return !1
						}
					}, ucweb.startRequest("shell.page_share", [a.title, a.desc, a.link + linkPlus, h, "", "", getPos.getNodeInfoById(g.id)])
				}
			};
		$(".share-wxfriend").on("touchstart", function() {
			$(this).addClass("active")
		}).on("touchend", function() {
			$(this).removeClass("active"), b("friend")
		}), $(".share-wxtimeline").on("touchstart", function() {
			$(this).addClass("active")
		}).on("touchend", function() {
			$(this).removeClass("active"), b("timeline")
		})
	}
}



if (function() {
	if (window.navigator.userAgent.indexOf("MicroMessenger") >= 0) {
		var a = document.createElement("script");
		a.type = "text/javascript", a.src = "/style/js/wx.js", document.body.appendChild(a);
		a.onload = function() {
			wxShare.init(CONFIG.wx_share_title, CONFIG.wx_share_desc, CONFIG.wx_share_link + "&f=" + CONFIG.f, CONFIG.img_url)
		}
	}
	ucShare({
		title: CONFIG.wx_share_title,
		desc: CONFIG.wx_share_desc,
		link: CONFIG.wx_share_link,
		img: CONFIG.img_url
	})
}(), CONFIG.isTop5) {} else $(".loading").remove();