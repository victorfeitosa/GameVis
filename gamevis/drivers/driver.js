DriverBase = "";

function BaseDriver() {
  this.ID = 0;
  this.SourceGame = "";
}

//Prototype properties
BaseDriver.prototype.Description = "BaseDriver Description";

//Prototype Methods

//Builds data from a source into a GameData object
BaseDriver.prototype.buildData = function (src) {
  return null;
};

//Returns a JSON/XML of the built GameData object
BaseDriver.prototype.getConvertedData = function (gamedata, format) {
  return "";
};
