//TODO: Implement the dota driver to convert Valve's Dota2 game data to GameVis
//TODO: For now the driver only gets a whole match and puts it in a GameData as
//			best as it can. The options function should define how the requester
//			wants to get the game/match data, if 25 games (default), 1 or else.

//TODO: Take this code outta here:
/**
 **Retrieve the 25 last matches: https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=<key>
 **Retrieve matches from id: https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?start_at_match_id=27110133&key=<key>
 **
 **
 **/


//Dota2 Driver definition and implementation
//Dota2 plugin that converts a Dota2 Game JSON to a GameVis JSON
DotaDriver.prototype = new BaseDriver();
DotaDriver.prototype.constructor = DotaDriver;

function DotaDriver() {
  //TODO: Steam doesnt support inter page access, we're gonna have to save the
  //jsons to our own servers and get them from there for now...
  var self = this;

  self.ID = 1;
  self.SourceGame = 'Dota 2';

	self.httpGet = function (theUrl) {
		var xmlHttp = null;

		//NOTE THAT WERE USING JSONP
		theUrl = 'http://jsonp.nodejitsu.com/?url=' + theUrl;

		xmlHttp = new XMLHttpRequest();
		xmlHttp.open("GET", theUrl, false);
		xmlHttp.setRequestHeader('Content-Type', 'application/json');
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
  //TODO: Implement for XML as well....
  var jsonobj = JSON.parse(self.httpGet(src));

  //gets the game info into the gamedata

  //transfers the players info into the gamedata

  //transfer the teams info to the gamedata

  //transfers the matchs info into the gamedata

  //returns the new GameData

  return jsonobj;
};

//Returns a JSON/XML of the built GameData object
DotaDriver.prototype.getConvertedData = function (gamedata, format) {
  //returns the built GameData as a JSON/XML
  return "";
};
