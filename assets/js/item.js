var item = function (pname, pimage, pdesc, pvalue, pnsfw) {

	thisitem = this;

	if (pname && pname != "") {
		this.name = pname;
		this.image = pimage;
		this.desc = pdesc;
		this.value = pvalue;
		this.nsfw = pnsfw;
	}

	this.fetch = function (pmethod) {
		if (pmethod == "fuck") {
			this.name = "fuck";
			this.image = "fuck.jpg";
			this.desc = "fuck";
			this.value = 666;
			this.nsfw = true;
		}
	}
}