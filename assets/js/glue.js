$(document).ready(function () {
	$(".box").click(function () {
		process();
	});
})

function display (pitem, pelement) {
	pelement.html("");
	pelement.append(
		$("<div></div>").attr("class", "item").append(
			$("<img>").attr("class", "image img-rounded").attr("src", imagepath + pitem.image),
			$("<br>"),
			$("<h1></h1>").html(pitem.name),
			$("<br>"),
			$("<p></p>").html(pitem.desc),
			$("<br>"),
			$("<a></a>").attr("class", "btn btn-mini return").attr("href", "index.html").html("return")
		)
	)
}