imagepath = "assets/img/item/"

function process() {
	var ajacks = $.ajax({
		url: "../../ss/backend.php",
		type: "POST",
		data: {action: "get"}
	})

	ajacks.done(function (data) {
		display(data, $(".stage"))
	})
}
