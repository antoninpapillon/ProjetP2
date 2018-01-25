(function () {
	document.addEventListener("DOMContentLoaded", function () {
		var lines = document.querySelectorAll(".module,.test");
		document.addEventListener("click", function (e) {
			var selected = document.querySelectorAll(".selected");
			if (selected && selected.length > 0) {
				for (var j = 0; j < selected.length; j++) {
					selected[j].classList.remove("selected");
				}
			}
			for (var i = 0; i < lines.length; i++) {
				if (lines[i].contains(e.target)) {
					lines[i].classList.add("selected");
				}
			}
		});
	});
} ());