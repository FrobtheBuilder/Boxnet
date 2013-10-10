$(document).ready(function() {
    $(".box").click(function() {
        if ($(".sfw").attr("checked")) {
            process(false);
        }
        else {
            process(true);
        }
    });
})

function display (pitem, pelement) {
	pelement.html("");
	pelement.append(
		$("<div></div>").attr("class", "panel panel-default item").append(
            $("<div></div>").attr("class", "panel-heading").append(
                $("<img>").attr("class", "image img-rounded").attr("src", imagepath + pitem.image)
			),
			$("<div></div>").attr("class", "panel-body").css("padding", "0").append(
                $("<h2></h2>").html(pitem.name)
            ),
            $("<div></div>").attr("class", "panel-footer").append(
                $("<p></p>").html(pitem.desc),
                $("<a></a>").attr("class", "btn btn-mini return").attr("href", "index.html").html("return")
            )
            
		)
	)
}