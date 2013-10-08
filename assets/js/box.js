imagepath = "assets/img/item/"

function process(nsfw) {
    globalnsfw = nsfw;
	var ajacks = $.ajax({
		url: "../../ss/backend.php",
		type: "POST",
		data: {action: "get"}
	})
    
	ajacks.done(function (data) {
	    console.log("Item NSFW:" + data.nsfw + " " + globalnsfw);
        if (!globalnsfw) {
            console.log("NSFW NOT ALLOWED");
            if (data.nsfw === "1") {
                process(false);
            }
            else {
                display(data, $(".stage"));
            }
        }
        else {
            display(data, $(".stage"));
        }
	})
}
