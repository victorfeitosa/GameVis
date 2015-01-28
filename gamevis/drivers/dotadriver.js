//Dota2 Driver definition and implementation
//Dota2 plugin that converts a Dota2 Game JSON to a GameVis JSON

define(function (require) {

	BaseDriver = require('drivers/basedriver');
	data = require('gamevis/data');

	DotaDriver.prototype = new BaseDriver();
	DotaDriver.prototype.constructor = DotaDriver;

	function DotaDriver() {
		var self = this;

		self.ID = 1;
		self.SourceGame = 'Dota 2';

		self.httpGet = function (theUrl) {
			var xmlHttp = null;

			xmlHttp = new XMLHttpRequest();
			xmlHttp.open("GET", theUrl, false); //false is set so the file is not streamed
			xmlHttp.send(null);

			return xmlHttp.responseText;
		};

		//Converts 32bit ids of Steam to 64bit ids used in most cases...
		self.convertId = function (id) {
			var converted = '';

			if (id.length === 17) {
				converted = (parseInt(id.substr(3)) - 61197960265728).toString();
			} else {
				var intid = parseInt(id);
				intid = intid + 61197960265728;
				intid = intid.toString();
				converted = '765' + intid;
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
		var gamedata = new data.GameData();

		//Since this is a mockup driver, the src is not used, instead this is hardcoded
		var jsonmatch = JSON.parse(this.httpGet('/gamevis/matchs/match.json')).result;
		var jsonplayers = JSON.parse(this.httpGet('/gamevis/matchs/players.json'))
			.response;

		//TODO: parse json objecta to gamedata object
		gamedata.setGameName('Dota2 Match ' + jsonmatch.match_id);
		gamedata.setGameId(0);
		gamedata.setGameCategory('MOBA');
		gamedata.setGameDescription("Dota2 is a MOBA game by Valve and IceFrog. " +
			"\nIt is the sequel to the Warcraft 3 mod " +
			"Defense Of The Ancients and it's one of " +
			"the most popular game of all time.");
		//add players, teams and matchs
		for (var i in jsonmatch.players) {
			//create a player, assign its stuff and add him to the players list
			var p = new data.Player();
			p.ID = this.convertId(jsonmatch.players[i].account_id);

			p.Name = undefined;
			p.Rank = 0;
			p.Nation = undefined;
			//finds player name (or not)
			for (var j in jsonplayers.players) {
				if (p.ID === jsonplayers.players[j].steamid) {
					p.Name = jsonplayers.players[j].personaname;
					p.Rank = jsonplayers.players[j].communityvisibilitystate;
					p.Nation = jsonplayers.players[j].loccountrycode;
					
					break;
				}
			}
			if (jsonmatch.players[i].player_slot < 5)
				p.Team = 'Radiant';
			else
				p.Team = 'Dire';

			gamedata.addGamePlayer(p);
		}


		return gamedata;
	};

	//Returns a JSON/XML of the built GameData object
	DotaDriver.prototype.getConvertedData = function (gamedata, format) {
		//returns the built GameData as a JSON/XML
		return "";
	};

	return DotaDriver;
});
