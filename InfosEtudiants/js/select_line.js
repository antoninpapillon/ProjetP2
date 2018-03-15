(function () {
	document.addEventListener("DOMContentLoaded", function () {
		var lines = Array.from(document.querySelectorAll(".unit,.module,.mark")),
			units = Array.from(document.querySelectorAll(".unit")),
			modules = Array.from(document.querySelectorAll(".module")),
			marks = Array.from(document.querySelectorAll(".mark"));
		// Mise en évidence d'une ligne par clic
		document.addEventListener("click", function (e) {
			var selected = document.querySelectorAll(".selected"),
				rem = true;
			if (selected && selected.length > 0) {
				for (var i = 0; i < units.length; i++) {
					if (units[i].contains(e.target))
						rem = false;
				}
				for (var i = 0; i < modules.length; i++) {
					if (modules[i].contains(e.target))
						rem = false;
				}
				if (rem) {
					for (var i = 0; i < selected.length; i++) {
						selected[i].classList.remove("selected");
					}
				}
			}
			for (var i = 0; i < marks.length; i++) {
				if (marks[i].contains(e.target)) {
					marks[i].classList.add("selected");
				}
			}
		});

		// Repli des modules par clic
		for (let i = 0; i < modules.length; i++) {
			modules[i].addEventListener("click", function (e) {
				var j = lines.findIndex(r => r == modules[i]) + 1,
					k = lines.find(r => r == modules[i + 1]) ? lines.findIndex(r => r == modules[i + 1]) : lines.length;
				for (var l = j; l < k; l++) {
					if (!lines[l].classList.contains("unit")) {
						switch (lines[l].style.display) {
							case "none":
								lines[l].style.display = "table-row";
								break;
							case "table-row":
							default:
								lines[l].style.display = "none";
								break;
						}
					}
					else l = k;
				}
			});
		}

		// Repli des UE par clic
		for (let j = 0; j < units.length; j++) {
			units[j].addEventListener("click", function (e) {
				var k = lines.findIndex(r => r == units[j]) + 1,
					m = lines.find(r => r == units[j + 1]) ? lines.findIndex(r => r == units[j + 1]) : lines.length;
				switch (lines[k].style.display) {
					case "none":
						for (var l = k; l < m; l++) {
							lines[l].style.display = "none";
						}
						break;
					case "table-row":
					default:
						for (var l = k; l < m; l++) {
							lines[l].style.display = "table-row";
						}
						break;
				}
				for (var l = k; l < m; l++) {
					switch (lines[l].style.display) {
						case "none":
							lines[l].style.display = "table-row";
							break;
						case "table-row":
						default:
							lines[l].style.display = "none";
							break;
					}
				}
			});
		}
	});
} ());