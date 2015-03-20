//******************************************************************************
//Game stuctures****************************************************************
//******************************************************************************

define(function (require) {
	require('d3/d3.v3');

	DEBUG = false;

	//'Globals'=====================================================================
	CurrentPlayerID = 0;
	CurrentTeamID = 0;
	CurrentMatchID = 0;

	//GameDataFormat enum
	GameDataFormat = 'JSON';

	CHART_STYLE_SOURCE = 'CSS';

	function isStyleSourceCSS() {
		return CHART_STYLE_SOURCE === 'CSS';
	}

	function isStyleSourceCode() {
		return CHART_STYLE_SOURCE === 'CODE';
	}

	function setChartStyleSource(source) {
		if (source === 'CSS' || source === 'CODE')
			CHART_STYLE_SOURCE = source;
		else {
			console.error('ERROR: STYLE SOURCE IS NOT VALID!');
		}
	}

	function getAspect() {
		var canvas = d3.select('svg');
		var width = canvas.attr('width');
		var height = canvas.attr('height');

		return (width/height);
	}

	function getResolution(){
		var canvas = d3.select('svg');
		var width = canvas.attr('width');
		var height = canvas.attr('height');

		return {w: width, h: height};
	}

	//Classes=======================================================================

	//load and save gamedata functions
	//@params: gamedata, format
	function saveGameData(obj) {
		var str = "";
		if (!object.format || !object.gamedata) {
			console.error('ERROR: object format could not be saved.', obj);
			return null;
		}
		format.toUpperCase();

		switch (obj.format) {
		case "JSON":
			str = JSON.stringify(obj.gamedata);
			break;
		case "XML":
			break;
		}

		return str;
	}

	//@params: stringdata, format
	function loadGameData(obj) {
		if (!obj.stringdata || !obj.format) {
			console.error('ERROR: object format could not be loaded.', obj);
			return null;
		}
		var gamedata = {};
		obj.format.toUpperCase();

		switch (obj.format) {
		case "JSON":
			gamedata = JSON.parse(obj.stringdata);
			break;
		case "XML":
			break;
		}

		return gamedata;
	}


	//Game data structure, can be inherited and overridden if the user needs a custom game data format
	function GameData() {}

	GameData.prototype.GameId = 0;
	GameData.prototype.GameName = '';
	GameData.prototype.GameCategory = '';
	GameData.prototype.GameDescription = '';
	GameData.prototype.GameTeams = [];
	GameData.prototype.GameMatches = [];
	GameData.prototype.GamePlayers = [];

	GameData.prototype.setGameName = function (name) {
		this.GameName = name;
	};

	GameData.prototype.setGameId = function (id) {
		this.GameId = id;
	};

	GameData.prototype.setGameCategory = function (cat) {
		this.GameCategory = cat;
	};

	GameData.prototype.setGameDescription = function (desc) {
		this.GameDescription = desc;
	};

	GameData.prototype.addGameTeam = function (team) {
		this.GameTeams.push(team);
	};

	GameData.prototype.addGamePlayer = function (player) {
		this.GamePlayers.push(player);
	};

	GameData.prototype.addGameMatch = function (match) {
		this.GameMatches.push(match);
	};

	//Canvas class----------------------------------------------------
	//@params: width, height, label, bgcolor
	function Canvas(obj) {

		this.ClassType = "Canvas";
		if (obj) {
			this.Width = obj.width || 640;
			this.Height = obj.height || 480;
			this.BGColor = obj.bgcolor || '#444444';
			this.Label = obj.label || 'Canvas';
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.SVGCanvas = null;
	}

	//Methods---
	Canvas.prototype.append = function () {
		//actual appending
		if (this.SVGCanvas === null) {
			this.SVGCanvas = d3.select("body").append("svg")
				.attr("width", this.Width)
				.attr("height", this.Height)
				.classed("canvas", true);

			if (isStyleSourceCode()) {
				if (this.BGColor === undefined)
					this.BGColor = "0xAAAAAA";
			}
		}
	};

	Canvas.prototype.remove = function () {
		if (this.SVGCanvas !== null)
			this.SVGCanvas.remove();
	};

	Canvas.prototype.getCanvas = function () {
		return this.SVGCanvas;
	};

	//@params: id, name, value, iconuri
	//Resouce Class---------------------------------------------------------------
	function Resource(obj) {
		this.ClassType = 'Resource';
		if (obj) {
			this.ID = obj.id;
			this.Name = obj.name;
			this.Value = obj.value;
			this.IconURI = obj.iconuri;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;
	}

	//Player Class------------------------------------------------------
	//@attr: name, rank, team, nation, tgold, txp, level, thumbnail
	function Player(obj) {
		//Attributes------------------------------------------------------------
		this.ClassType = "Player";

		//Global attributes
		CurrentPlayerID = CurrentPlayerID + 1;
		this.ID = CurrentPlayerID;

		if (obj) {
			this.Name = obj.name;
			this.Rank = obj.rank;
			this.Team = obj.team;
			this.Nation = obj.nation;
			this.TotalGold = obj.tgold;
			this.TotalXP = obj.txp;
			this.Level = obj.level;
			this.Thumbnail = obj.thumbnail;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		//Match attributes
		this.CurrentGold = 0;
		this.CurrentXP = 0;
		this.CurrentKills = 0;
		this.CurrentDeaths = 0;
		this.CurrentAssists = 0;
		this.Status = []; //frag, death, gold
		this.Resources = {};
	}

	//Methods------------------------------------------------------------------
	Player.prototype.print = function () {
		console.log("Name: " + this.Name);
		console.log("Rank: " + this.Rank);
		console.log("Team: " + this.Team);
		console.log("Nation: " + this.Nation);
		console.log("Total Gold: " + this.TotalGold);
		console.log("Total XP: " + this.TotalXP);
		console.log("Thumbnail: " + this.Thumbnail);
	};

	Player.prototype.addDeath = function (time) {
		this.CurrentDeaths++;
		this.CurrentGold -= 100 + time;
		this.TotalGold -= 100 + time;

		//reality check
		if (this.CurrentGold < 0)
			this.CurrentGold = 0;
		if (this.TotalGold < 0)
			this.TotalGold = 0;

		this.Status.push([time, "death"]);
	};

	Player.prototype.addGold = function (time, amount) {
		this.CurrentGold += amount;
		this.TotalGold += amount;
		this.Status.push([time, "gold"]);
	};

	Player.prototype.addXP = function (amount) {
		this.CurrentXP += amount;
		this.TotalXP += amount;
	};

	Player.prototype.addKill = function (time) { //adds a kill, xp and gold and informs who was killed
		this.CurrentKills++;
		this.addXP(200);

		this.CurrentGold += 250;
		this.TotalGold += 250;

		this.Status.push([time, "frag"]);
	};

	Player.prototype.addResourceGroup = function (group) {
		this.Resources[group] = {};
	};
	Player.prototype.removeResourceGroup = function (group) {
		this.Resources[group] = undefined;
	};
	Player.prototype.addResource = function (group, resource, time) {
		if (this.Resources[group] !== undefined && time >= 0) {
			this.Resources[group][time] = resource;
		} else if (this.Resources[group] !== undefined && time == -1) {
			this.Resources[group] = resource;
		}
	};
	Player.prototype.removeResource = function (group, resource, time) {
		if (this.Resources[group] !== undefined) {
			this.Resources[group][time] = null;
		}
	};

	//@params: name, rank, nation
	//Team Class------------------------------------------------------------------
	function Team(obj) {
		//Attributes----------------------------------------------------------------

		CurrentTeamID = CurrentTeamID + 1;
		this.ID = CurrentTeamID;
		this.ClassType = "Team";

		if (obj) {
			//Team common attributes
			this.Name = obj.name;
			this.Rank = obj.rank;
			this.Nation = obj.nation;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		//Team attributes calculated on-demand
		this.Players = [];
		this.Gold = 0;
		this.NumKills = 0;
		this.AverageLevel = 0;
		this.Resources = [];
	}

	//Methods---------------------------------------------------------------------
	//Calculates the stuff
	Team.prototype.getAverageLevel = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].Level;
		}

		n /= this.Players.length;
		this.AverageLevel = n;

		return n;
	};

	Team.prototype.getKills = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentKills;
		}

		this.NumKills = n;

		return n;
	};

	Team.prototype.getDeaths = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentDeaths;
		}

		return n;
	};

	Team.prototype.getXP = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentXP;
		}

		return n;
	};

	Team.prototype.getGold = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentGold;
		}

		this.Gold = n;

		return n;
	};

	//add/remove  Players
	Team.prototype.addPlayer = function (player) {
		this.Players.push(player);
	};

	this.removePlayer = function (ppos) {
		this.Players.splice(ppos, 1);
	};

	Team.prototype.print = function () {
		console.log("Team " + self.Name + " profile:");
		console.log("-Players: ");
		for (var i in this.Players) {
			console.log("Player[" + i + 1 + "]: " + this.Players[i].Name);
		}
		console.log("-XP: " + this.getXP());
		console.log("-Gold: " + this.getGold());
	};
	Team.prototype.addResourceGroup = function (group) {
		this.Resources[group] = {};
	};
	Team.prototype.removeResourceGroup = function (group) {
		this.Resources[group] = undefined;
	};
	Team.prototype.addResource = function (group, resource, time) {
		if (this.Resources[group] !== undefined && time >= 0) {
			this.Resources[group][time] = resource;
		} else if (this.Resources[group] !== undefined && time == -1) {
			this.Resources[group] = resource;
		}
	};
	Team.prototype.removeResource = function (group, resource, time) {
		if (this.Resources[group] !== undefined) {
			this.Resources[group][time] = null;
		}
	};

	//@attrs: team1, team2, endtime
	//Match Class---------------------------------------------------------------
	function Match(obj) {
		//This match can be either a result-only match or a event-result match
		//Attributes

		CurrentMatchID = CurrentMatchID + 1;
		this.ID = CurrentMatchID;
		this.ClassType = "Match";

		if (obj) {
			this.Team = [];
			this.Team[0] = obj.team1;
			this.Team[1] = obj.team2;

			this.CurrentTime = 0;
			this.EndTime = obj.endtime || 100;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.GoldDifference = [];
		this.XPDifference = [];
		this.KillDifference = [];
	}

	//Methods---------------------------------------------------------------------
	Match.prototype.init = function () {
		if (this.EndTime > 0) {
			//init difference arrays and player time array
			for (var i = 0; i < self.EndTime; i++) {
				this.GoldDifference.push(0);
				this.KillDifference.push(0);
				this.XPDifference.push(0);
			}
		}
	};

	//update stuff from teams and players-----------------------------------------
	Match.prototype.addPlayerKill = function (killerTeam, victimTeam, killer,
		victim) {

		if ((killer.ClassType === "Player" && victim.ClassType ===
				"Player") &&
			(killerTeam.ClassType === "Team" && victimTeam.ClassType ===
				"Team") &&
			this.CurrentTime < this.EndTime) {
			killer.addKill(this.CurrentTime);
			victim.addDeath(this.CurrentTime);
			killerTeam.getKills();
			victimTeam.getDeaths();
		}
	};

	Match.prototype.addPlayerGold = function (team, player, amount) {
		if (this.CurrentTime < this.EndTime) {
			player.addGold(this.CurrentTime, amount);
			team.getGold();
		}
	};

	Match.prototype.addPlayerXP = function (team, player, amount) {
		if (this.CurrentTime < this.EndTime) {
			player.addXP(amount);
			team.getXP();
		}
	};

	Match.prototype.getMatchTime = function (time) {
		return this.CurrentTime;
	};

	//return differences according to time
	Match.prototype.calculateDifference = function (time, what) {
		var ret = 0;
		switch (what) {
		case "Gold":
			ret = this.Team[1].getGold() - this.Team[0].getGold();
			break;
		case "XP":
			ret = this.Team[1].getXP() - this.Team[0].getXP();
			break;
		case "Kills":
			ret = this.Team[1].getKills() - this.Team[0].getKills();
			break;
		}
		return ret;
	};

	Match.prototype.getDifference = function (time, what) {
		var ret = 0;
		if (time <= this.EndTime) {
			this.calculateDifference(time, what);

			switch (what) {
			case "Gold":
				ret = this.GoldDifference[time];
				break;
			case "XP":
				ret = this.XPDifference[time];
				break;
			case "Kills":
				ret = this.KillDifference[time];
				break;
			}
		} else {
			console.log("Couldnt get difference of time " + time);
		}

		return ret;
	};

	//reappends the match status adding kills, gold, etc
	Match.prototype.reappend = function () {
		var time = this.CurrentTime;
		if (time <= this.EndTime) {
			this.GoldDifference.push(this.calculateDifference(time, "Gold"));
			this.XPDifference.push(this.calculateDifference(time, "XP"));
			this.KillDifference.push(this.calculateDifference(time, "Kills"));

			this.CurrentTime++;
		}
	};

	Match.prototype.build = function () {
		for (var time = 0; time < this.EndTime; time++) {
			this.GoldDifference.push(this.calculateDifference(time, "Gold"));
			this.XPDifference.push(this.calculateDifference(time, "XP"));
			this.KillDifference.push(this.calculateDifference(time, "Kills"));
		}
	};

	Match.prototype.update = function () {
		var time = this.CurrentTime;
		if (time <= this.EndTime) {
			this.GoldDifference.push(this.calculateDifference(time, "Gold"));
			this.XPDifference.push(this.calculateDifference(time, "XP"));
			this.KillDifference.push(this.calculateDifference(time, "Kills"));

			this.CurrentTime++;
		}
	};

	//@attrs: team1, team2
	//RealTimeMatch Class---------------------------------------------------------
	//TODO: Implement this
	function RealTimeMatch() {

		//Attributes----------------------------------------------------------------
		CurrentMatchID = CurrentMatchID + 1;
		this.ID = CurrentMatchID;
		this.ClassType = "RealTimeMatch";
		this.Team1 = obj.team1;
		this.Team2 = obj.team2;

		this.CurrentTime = 0;
		this.Ended = false;

		this.GoldDifference = [];
		this.XPDifference = [];
		this.KillDifference = [];
	}

	//Methods-------------------------------------------------------------

	RealTimeMatch.prototype.getCurrentTime = function () {
		return this.CurrentTime;
	};

	RealTimeMatch.prototype.reappend = function () {

	};

	//returns all globals and classes in a gamevis.data object
	return {
		//variables
		DEBUG: DEBUG,
		CurrentPlayerID: CurrentPlayerID,
		CurrentTeamID: CurrentTeamID,
		CurrentMatchID: CurrentMatchID,
		GameDataFormat: GameDataFormat,
		CHART_STYLE_SOURCE: CHART_STYLE_SOURCE,

		//functions
		isStyleSourceCSS: isStyleSourceCSS,
		isStyleSourceCode: isStyleSourceCode,
		setChartStyleSource: setChartStyleSource,
		getAspect: getAspect,
		getResolution: getResolution,
		saveGameData: saveGameData,
		loadGameData: loadGameData,

		//classes
		GameData: GameData,
		Canvas: Canvas,
		Resource: Resource,
		Player: Player,
		Team: Team,
		Match: Match //,
			//RealTimeMatch: RealTimeMatch
	};
});
