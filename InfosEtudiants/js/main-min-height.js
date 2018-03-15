(function () {
	document.addEventListener("DOMContentLoaded", resize_main);
	window.addEventListener("resize", resize_main);
	function resize_main () {
		var head = document.querySelector("header"),
			main = document.querySelector("main"),
			foot = document.querySelector("footer"),
			sectionsOdd = document.querySelectorAll("section:nth-of-type(odd)"),
			headHeight = head.offsetHeight,
			footHeight = foot.offsetHeight,
			mainHeight = window.innerHeight - headHeight - footHeight;
		main.style.minHeight = mainHeight + "px";
		if (document.querySelector("section:nth-of-type(2)")) {
			if (window.innerWidth > 1024) {
				for (var i = 0; i < sectionsOdd.length; i++) {
					var sectionsMargin = window.innerWidth - document.querySelector("section:nth-of-type(" + (i + 2) + ")").offsetWidth - sectionsOdd[i].offsetWidth - 40;
					sectionsOdd[i].style.marginRight = sectionsMargin + "px";
				}
			}
			else {
				for (var i = 0; sectionsOdd.length; i++) {
					sectionsOdd[i].style.marginRight = "0px";
				}
			}
		}
	}
} () );