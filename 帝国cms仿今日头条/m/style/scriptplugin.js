//swipe.js;
window.Swipe = function(a, b) {
	if (!a)
		return null;
	var c = this;
	this.options = b || {};
	this.index = this.options.startSlide || 0;
	this.speed = this.options.speed || 400;
	this.callback = this.options.callback ||
	function() {
	};
	this.delay = this.options.auto || 0;
	this.container = a;
	this.element = this.container.children[0];
	this.container.style.overflow = 'hidden';
	this.element.style.listStyle = 'none';
	this.element.style.margin = 0;
	this.setup();
	this.begin();
	if (this.element.addEventListener) {
		this.element.addEventListener('touchstart', this, false);
		this.element.addEventListener('touchmove', this, false);
		this.element.addEventListener('touchend', this, false);
		this.element.addEventListener('touchcancel', this, false);
		this.element.addEventListener('webkitTransitionEnd', this, false);
		this.element.addEventListener('msTransitionEnd', this, false);
		this.element.addEventListener('oTransitionEnd', this, false);
		this.element.addEventListener('transitionend', this, false);
		window.addEventListener('resize', this, false)
	}
};
Swipe.prototype = {
	setup : function() {
		this.slides = this.element.children;
		this.length = this.slides.length;
		if (this.length < 2)
			return null;
		this.width = Math.ceil(("getBoundingClientRect" in this.container) ? this.container.getBoundingClientRect().width : this.container.offsetWidth);
		if (this.width === 0 && typeof window.getComputedStyle === 'function') {
			this.width = window.getComputedStyle(this.container, null).width.replace('px', '')
		}
		if (!this.width)
			return null;
		var a = this.container.style.visibility;
		this.container.style.visibility = 'hidden';
		this.element.style.width = Math.ceil(this.slides.length * this.width) + 'px';
		var b = this.slides.length;
		while (b--) {
			var c = this.slides[b];
			c.style.width = this.width + 'px';
			c.style.display = 'table-cell';
			c.style.verticalAlign = 'top'
		}
		this.slide(this.index, 0);
		this.container.style.visibility = a
	},
	slide : function(a, b) {
		var c = this.element.style;
		if (b == undefined) {
			b = this.speed
		}
		c.webkitTransitionDuration = c.MozTransitionDuration = c.msTransitionDuration = c.OTransitionDuration = c.transitionDuration = b + 'ms';
		c.MozTransform = c.webkitTransform = 'translate3d(' + -(a * this.width) + 'px,0,0)';
		c.msTransform = c.OTransform = 'translateX(' + -(a * this.width) + 'px)';
		this.index = a
	},
	getPos : function() {
		return this.index
	},
	prev : function(a) {
		this.delay = a || 0;
		clearTimeout(this.interval);
		if (this.index)
			this.slide(this.index - 1, this.speed);
		else
			this.slide(this.length - 1, this.speed)
	},
	next : function(a) {
		this.delay = a || 0;
		clearTimeout(this.interval);
		if (this.index < this.length - 1)
			this.slide(this.index + 1, this.speed);
		else
			this.slide(0, this.speed)
	},
	begin : function() {
		var a = this;
		this.interval = (this.delay) ? setTimeout(function() {
			a.next(a.delay)
		}, this.delay) : 0
	},
	stop : function() {
		this.delay = 0;
		clearTimeout(this.interval)
	},
	resume : function() {
		this.delay = this.options.auto || 0;
		this.begin()
	},
	handleEvent : function(e) {
		switch(e.type) {
			case'touchstart':
				this.onTouchStart(e);
				break;
			case'touchmove':
				this.onTouchMove(e);
				break;
			case'touchcancel':
			case'touchend':
				this.onTouchEnd(e);
				break;
			case'webkitTransitionEnd':
			case'msTransitionEnd':
			case'oTransitionEnd':
			case'transitionend':
				this.transitionEnd(e);
				break;
			case'resize':
				this.setup();
				break
		}
	},
	transitionEnd : function(e) {
		if (this.delay)
			this.begin();
		this.callback(e, this.index, this.slides[this.index])
	},
	onTouchStart : function(e) {
		this.start = {
			pageX : e.touches[0].pageX,
			pageY : e.touches[0].pageY,
			time : Number(new Date())
		};
		this.isScrolling = undefined;
		this.deltaX = 0;
		this.element.style.MozTransitionDuration = this.element.style.webkitTransitionDuration = 0;
		e.stopPropagation()
	},
	onTouchMove : function(e) {
		if (e.touches.length > 1 || e.scale && e.scale !== 1)
			return;
		this.deltaX = e.touches[0].pageX - this.start.pageX;
		if ( typeof this.isScrolling == 'undefined') {
			this.isScrolling = !!(this.isScrolling || Math.abs(this.deltaX) < Math.abs(e.touches[0].pageY - this.start.pageY))
		}
		if (!this.isScrolling) {
			e.preventDefault();
			clearTimeout(this.interval);
			this.deltaX = this.deltaX / ((!this.index && this.deltaX > 0 || this.index == this.length - 1 && this.deltaX < 0) ? (Math.abs(this.deltaX) / this.width + 1) : 1);
			this.element.style.MozTransform = this.element.style.webkitTransform = 'translate3d(' + (this.deltaX - this.index * this.width) + 'px,0,0)';
			e.stopPropagation()
		}
	},
	onTouchEnd : function(e) {
		var a = Number(new Date()) - this.start.time < 250 && Math.abs(this.deltaX) > 20 || Math.abs(this.deltaX) > this.width / 2, isPastBounds = !this.index && this.deltaX > 0 || this.index == this.length - 1 && this.deltaX < 0;
		if (!this.isScrolling) {
			this.slide(this.index + (a && !isPastBounds ? (this.deltaX < 0 ? 1 : -1) : 0), this.speed)
		}
		e.stopPropagation()
	}
};
