
//Dota2 Driver definition and implementation
//Dota2 plugin that converts a Dota2 Game JSON to a GameVis JSON
DotaDriver.prototype = new BaseDriver();
DotaDriver.prototype.constructor = DotaDriver;

function DotaDriver() {
  //TODO: Steam doesnt support inter page access, we're gonna have to save the
  //jsons to our own servers and get them from there for now...
  self = this;

  self.ID = 1;
  self.SourceGame = 'Dota 2';

	self.httpGet = function (theUrl) {
		var xmlHttp = null;

		xmlHttp = new XMLHttpRequest();
		xmlHttp.open("GET", theUrl, false);//false is set so the file is not streamed
		xmlHttp.send(null);

		return xmlHttp.responseText;
	};

  //Converts 32bit ids of Steam to 64bit ids used in most cases...
  self.convertID = function (id) {
    var converted = 0;

    if (id.length == 17) {
      converted = parseInt(id.substr(3)) - 61197960265728;
    } else {
      converted = '765' + (parseInt(id) + 61197960265728);
    }

    return converted;
  };
}

/**jshint multistr:true**/
DotaDriver.prototype.Description =
  "This is a driver for the Dota2 game.\nThis " +
  "code gets a Valve match data in XML or JSON " +
  "and converts it into a GameVis GameData or " +
  "JSON/XML format.";

//Set options for the driver data building and converting
DotaDriver.prototype.setOptions = function (optArray) {
  //TODO: implement this
  //options: []
};

//Builds data from a source into a GameData object
DotaDriver.prototype.buildData = function (src) {
	var gamedata = new GameData();

	var match = JSON.parse(self.httpGet(src));

	//TODO: parse json objecta to gamedata object


	return gamedata;
};

//Returns a JSON/XML of the built GameData object
DotaDriver.prototype.getConvertedData = function (gamedata, format) {
  //returns the built GameData as a JSON/XML
  return "";
};
