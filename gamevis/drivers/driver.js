//Driver baseclass
function BaseDriver() {
	this.ID = 0;
	this.SourceGame = "";
}

//Prototype properties
BaseDriver.prototype.self = BaseDriver.this;
BaseDriver.prototype.Description = "BaseDriver Description";

//Prototype Methods
BaseDriver.prototype.buildData = function () {
	return null;
}
BaseDriver.prototype.getConvertedData = function (format) {
	return "";
}
