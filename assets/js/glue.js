$(document).ready(function () {
	$(".box").click(function () {
		process();
	});
})

function display (pitem, pelement) {
	pelement.html("");
	pelement.append(
		$("<div></div>").attr("class", "item").append(
			$("<h1></h1>").html(pitem.name),
			$("<br>"),
			$("<img>").attr("src", imagepath + pitem.image),
			$("<br>"), $("<br>"), $("<br>"),
			$("<p></p>").html(pitem.desc)
		)
	)
}