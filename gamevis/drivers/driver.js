//NOTE: RealTimeMatch drivers will be implemented differently because of their
//      socket connection and constant update nature. 

function BaseDriver() {
  this.ID = 0;
  this.SourceGame = "";
}

//Prototype properties
BaseDriver.prototype.Description = "BaseDriver Description";

//Prototype Methods

//Set options for the driver data building and converting
BaseDriver.prototype.setOptions = function (optArray) {
  //set options of the driver, whichever they are and in whatever number they are
};

//Builds data from a source into a GameData object
BaseDriver.prototype.buildData = function (src) {
  return null;
};

//Returns a JSON/XML of the built GameData object
BaseDriver.prototype.getConvertedData = function (gamedata, format) {
  return "";
};
