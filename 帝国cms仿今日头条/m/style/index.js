function tabber(a, b) {
	for (var i = 0; i < b.length; i++) {
		b[i].className = b[i].className.replace('current', ' ')
	}
	a.className += ' current'
};
initSlide('slider');

function initSlide(b) {
	var c = document.getElementById(b);
	var d = c.querySelectorAll('.in');
	if (!c) {
		return false
	}
	if (!d) {
		return false
	}
	var f = new Swipe(c, {
		callback: function(e, a) {
			tabber(d[a], d)
		},
		auto: 3000
	})
}



