/* 游戏截图左右滑动*/
jQuery(function($) {
    $.extend({
        ns:function(namespace, context) {
            var parent = (context == null) ? window : context;
            var arr = namespace.split('.');
            for (var i = 0; i < arr.length; i++) {
                if (!!!parent[arr[i]]) {
                    parent[arr[i]] = {};
                }
                parent = parent[arr[i]];
            }

            // 例如: 支持 namespace = $.ns('dao.cube.modules')
            return parent;
        },
        /**
         * 查看某个Module是否在Namespace中定义， 原理同{$.ns()}
         * @param {Object} moduleName
         * @param {Object} context
         */
        require_module:function(moduleName, context) {
            var parent = (context == null) ? window : context;
            var arr = moduleName.split('.');
            for (var i = 0; i < arr.length; i++) {
                if (!!!parent[arr[i]]) {
                    throw new Error("required module not found: " + moduleName);
                }
                parent = parent[arr[i]];
            }
            return parent;
        }
    });
});


jQuery(function($) {

    // 默认配置
    var DefaultConf = {
        'preCount': 3,
        'container': null
    };

    var Slide = function(conf){
        this.conf = $.extend({}, DefaultConf, conf);
        this.init(conf);
    };

    Slide.prototype = {
        init: function(conf){
            // 初始状态
            this.preCount = this.conf.preCount;
            this.container = this.conf.container;
            this.items = this.container.find(this.conf.items);
            this.size = this.items.length;
            this.totalPage = Math.ceil(this.size / this.preCount);
            this.itemWidth = this.items.first().outerWidth(true);
            this.pageIndex = 1;

            // 为循环流畅滑动，前后各增加一页
            var aItems = this.items.filter(':lt('+this.preCount+')');
            var bItems = this.items.filter(':gt('+(this.size - this.preCount - 1)+')');
            aItems.clone().appendTo(this.container);
            bItems.clone().prependTo(this.container);

            // 初始slide的位置
            this.container.css({
                'left' : -(this.itemWidth * this.preCount),
                'width': this.itemWidth * ( this.size + 2 * this.preCount )
            });
        },
        next: function(callback){
            this.pageIndex++;
            if(this.pageIndex > this.totalPage){
                this.pageIndex = 1;
                this.container.css({
                    'left': 0
                });
            }
            this.animate(callback);
        },
        prev: function(callback){
            this.pageIndex--;
            if(this.pageIndex < 1){
                this.pageIndex = this.totalPage;
                this.container.css({
                    'left': -(this.itemWidth * (this.size + this.preCount))
                });
            }
            this.animate(callback);
        },
        jump: function(pIndex, callback){
            this.pageIndex = (pIndex < 1) ? 1 :
                (pIndex > this.totalPage) ? this.totalPage : pIndex;
            this.animate(callback);
        },
        animate: function(callback){
            var self = this;
            var distance = -(this.pageIndex * this.preCount * this.itemWidth);
            this.container.animate({
                'left': distance
            }, function(){
                if($.isFunction(callback)){
                    callback.apply(self, [self.pageIndex]);
                }
            });
        }
    };

    var namespaceName = 'dao.search.video.index',
    NameSpace = $.ns(namespaceName);
    NameSpace.Slide = Slide;
});jQuery(function($) {
    var namespaceName = 'dao.search.video.index',
    NameSpace = $.ns(namespaceName);

    /**
     * slide模块鼠标hover
     * 效果：高亮 + 信息框上移 
     */
    var slideHoverItemSelector = '#slide .bd li';
    NameSpace.slideModsItemMouseHover = function(){
        $(slideHoverItemSelector).live('mouseover', function(evt){
            var self = $(this);
            self.find('.shadow-vanish').removeClass('inner-shadow');
            var iwrap = self.find('.info-wrap');
            iwrap.stop(true).animate({
                'top': 0
            }, 'fast');
        }).live('mouseout', function(evt){
            var self = $(this);
            self.find('.shadow-vanish').addClass('inner-shadow');
            var iwrap = self.find('.info-wrap');
            iwrap.stop(true).animate({
                'top': 96
            }, 'fast');
        });
    };
    /**
     * 左模块鼠标hover
     */
    var leftHoverItemSelector = '#indexmain .mod-left .js-toggle li .photo a';
    NameSpace.leftModsItemMouseHover = function(){
        $(leftHoverItemSelector).live('mouseover', function(){
            $(this).closest('li').addClass('active');
            //var self = $(this);
            //self.find('.photo-bg').addClass('active');
        }).live('mouseout', function(){
            $(this).closest('li').removeClass('active');
            //var self = $(this);
            //self.find('.photo-bg').removeClass('active');
        });
    };

    /**
     * 右模块鼠标hover
     */
    var rightHoverItemSelector = '#indexmain .mod-right .js-toggle li';
    NameSpace.rightModsItemMouseHover = function(){
        $(rightHoverItemSelector).live('mouseover', function(){
            var self = $(this);
            var tooltips = self.find('.tooltips').show();
            var arrow = self.find('.arrow').show();
            var totalHeight = self.closest('ol').height();
            var position = self.position();
            var offset = totalHeight - position.top - tooltips.outerHeight();
            if(offset < 0){
                tooltips.css({
                    'top': offset
                });
            }
        }).live('mouseout', function(){
            var self = $(this);
            self.find('.tooltips, .arrow').hide();
        });
    };
});

jQuery(function($) {
    var namespaceName = 'dao.search.video.index',
    NameSpace = $.ns(namespaceName);

    var Slide = $.require_module('dao.search.video.index.Slide');

    NameSpace.initSlide = function(){

        // 创建slide实例
        var $slide = new Slide({
            'preCount': 3,
            'container': $('#slide .cover ul'),
            'items': 'li'
        });

        // 当前是否正在动画中
        var inAnimate = false;

        // 左滑动按钮的事件处理
        $('#slide .bd .left-btn').live('click',function(evt){
            // for request log
            var reqLogDetail = [
                "type=" + encodeURIComponent("左按钮")
            ].join('&');
            _reqlog('index', 'clickSlide', reqLogDetail);

            if(inAnimate){
                return false;
            }
            inAnimate = true;
            $slide.prev(function(pageIndex){
                inAnimate = false;
                updateTabStatus(pageIndex);
            });
            evt.preventDefault();
        });

        // 右滑动按钮的事件处理
        $('#slide .bd .right-btn').live('click',function(evt){
            var reqLogDetail = [
                "type=" + encodeURIComponent("右按钮")
            ].join('&');
            _reqlog('index', 'clickSlide', reqLogDetail);

            if(inAnimate){
                return false;
            }
            inAnimate = true;
            $slide.next(function(pageIndex){
                inAnimate = false;
                updateTabStatus(pageIndex);
            });
            evt.preventDefault();
        });

        // tab 切换事件处理
        $('#slide .tab a').live('click', function(evt){
            var tab = $(this);
            var tabs = tab.closest('.tab').find('a');
            var pageIndex = tab.data('index');

            // for request log
            var reqLogDetail = [
                "type=" + encodeURIComponent(tab.text())
            ].join('&');
            _reqlog('index', 'clickSlide', reqLogDetail);

            if(inAnimate){
                return false;
            }
            if(!tab.hasClass('cur')){
                tabs.removeClass('cur');
                tab.addClass('cur');
                inAnimate = true;
                $slide.jump(pageIndex, function(){
                    inAnimate = false;
                });
            }
            evt.preventDefault();
        });

        /**
         * 更新 tab 状态
         * page   1  2  3  4  5  6  7  8
         * idx    1  1  2  2  3  3  4  4
         */
        var tabs = $('#slide .tab a');
        function updateTabStatus(pageIndex){
            var idx = Math.ceil(pageIndex/2) - 1;
            tabs.removeClass('cur');
            tabs.eq(idx).addClass('cur');
        }

        // =====================================================
        // = 自动播放
        // =====================================================
        var autoPlay = true;
        $('#slide, #slide .bd li').live('mouseover', function(evt){
            autoPlay = false;
        }).live('mouseout', function(evt){
            autoPlay = true;
        });
        window.setInterval(function(){
            if(!autoPlay) return;
            inAnimate = true;
            $slide.next(function(pageIndex){
                inAnimate = false;
                updateTabStatus(pageIndex);
            });
        }, 5000);
    };
});
jQuery(function($) {
    var namespaceName = 'dao.search.video.index',
    NameSpace = $.ns(namespaceName);
    // 初始化首页一些模块的鼠标hover效果
    NameSpace.slideModsItemMouseHover();
    // 初始化slide模块
    NameSpace.initSlide();

});

var _reqCount = (new Date()).getTime();  // 每次调用_requestLogger时都会变化, 防止不同的request会因为url相同而被取消
var _requestService = "/reqlogger";
/**
 * req_cat:reqlog的分类
 * opt_type:记录用户在这个分类下的操作类型，主要是为了反映用户在某个页面下的整体操作情况（比如首页我们希望记录用户搜索了几次，点了多少次分类，点了多少次视频播放等情况）
 * detail：考虑到不同的页面需要记录不同的参数，我们无法给一个通用的函数，所以干脆让用户自己填写想记录的内容
 * e.g: _reqlog('index', 'videoplay', 'play=tv&pos=3')
 */
function _reqlog(req_cat, opt_type, detail) {
    var params = "req_cat=" + req_cat;
    params += "&opt_type=" + opt_type;
    if (detail) {
        params += "&" + detail;
    }
    params += "&pwd=" + _reqCount++;
    (new Image()).src = _requestService + '?' + params;
};