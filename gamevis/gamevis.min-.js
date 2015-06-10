//******************************************************************************
//Game stuctures****************************************************************
//******************************************************************************
define(function (require) {
	gamevis = {};

	require('d3/d3');

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
			this.Parent = obj.parent || null;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.SVGCanvas = null;
	}

	//Methods---
	Canvas.prototype.append = function (arg) {
		if (arg !== undefined) {
			return this.SVGCanvas.append(arg);
		}
		//actual appending
		if (this.Parent) {
			this.SVGCanvas = d3.select(this.Parent).append("svg")
				.attr("width", this.Width)
				.attr("height", this.Height)
				.classed("canvas", true);
		}
		else{
			this.SVGCanvas = d3.select("body").append("svg")
				.attr("width", this.Width)
				.attr("height", this.Height)
				.classed("canvas", true);
		}

		if (isStyleSourceCode()) {
			if (this.BGColor === undefined)
				this.BGColor = "0xAAAAAA";
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
		what = what.toLowerCase();
		switch (what) {
		case "gold":
			ret = this.Team[1].getGold() - this.Team[0].getGold();
			break;
		case "xp":
			ret = this.Team[1].getXP() - this.Team[0].getXP();
			break;
		case "kills":
			ret = this.Team[1].getKills() - this.Team[0].getKills();
			break;
		}
		return ret;
	};

	Match.prototype.getDifference = function (time, what) {
		var ret = 0;
		if (time <= this.EndTime) {
			what = what.toLowerCase();
			this.calculateDifference(time, what);

			switch (what) {
			case "gold":
				ret = this.GoldDifference[time];
				break;
			case "xp":
				ret = this.XPDifference[time];
				break;
			case "kills":
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

	//****************************************************************************
	//Drawgin-related Structures**************************************************
	//****************************************************************************
	//class to controll a bar graph
	//@attributes: canvas, x, y, width, height, fill, stroke, stroke_width, fill_op, stroke_op
	function Bar(obj) {
		//attributes
		this.ClassType = 'Bar';

		if (obj) {
			//checks if it is a group or a canvas
			this.Canvas = obj.canvas;

			//--------------------------------------
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.Width = obj.width;
			this.Height = obj.height;
			this.Fill = obj.fill || '#AAA';
			this.FillFinal = obj.fill_final || this.Fill;
			this.Stroke = obj.stroke || '#777';
			this.StrokeWidth = obj.stroke_width || 1;
			this.FillOpacity = obj.fill_op || 1;
			this.StrokeOpacity = obj.stroke_op || 1;

			this.RealHeight = this.Height;

		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;
		//element to operate transition on
		this.Element = null;

	}

	//Methods-----

	Bar.prototype.append = function () {
		var self = this;
		var mx, my;

		//actual appending--------------------------------------------------------
		//appends in a canvas or group
		if (self.Canvas !== undefined && self.Element === null) {
			mx = self.X - self.Width / 2; //defines the bar X center
		  my = 0;
			if (self.Height < 0) {
				my = self.Y;
				self.Height *= -1;
			} else
				my = self.Y - self.Height;

			self.Element = self.Canvas.append('rect').classed('bar-element',
					true) //set initial attributes
				.attr('transform', function () {
					return 'translate(' + (mx) + ', ' + (my) + ')';
				})
				.attr('width', self.Width)
				.attr('height', 0)
				.style('fill', self.Fill);

			if (gamevis.data.isStyleSourceCode()) {
				self.Element.style('stroke', self.Stroke)
					.style('stroke-width', self.StrokeWidth)
					.style('fill-opacity', self.FillOpacity)
					.style('stroke-opacity', self.StrokeOpacity);
			}

			//applying height transition
			if (!self.Transition) {
				if (DEBUG)
					console.log(
						'Transition not defined for Bar, applying default transition'
					);
					if(self.RealHeight < 0 ){
						self.Element.transition()
							.attr('height', self.Height)
							.style('fill', self.FillFinal)
							.duration(1000)
							.delay(100);
					}
					else{
						self.Element.transition()
							.attr('transform', 'translate(' + self.X + ',' + self.Y + ')')
							.delay(0)
							.duration(0);

							self.Element.transition()
								.attr('height', self.Height)
								.attr('transform', 'translate(' + self.X + ',' + my + ')')
								.style('fill', self.FillFinal)
								.duration(1000)
								.delay(100);
					}
			}
		}

		return self;
	};

	Bar.prototype.remove = function () {
		if (this.Element !== null) {
			this.Element.remove();
			this.Element = null;
		}
	};

	Bar.prototype.reappend = function () { //instead of removing and re-appending, just make a transition
		this.remove();
		this.append();
	};

	Bar.prototype.get = function () {
		return this.Element;
	};

	Bar.prototype.transition = function () {
		return this.Element.transition();
	};

	Bar.prototype.classed = function (c, b) {
		return this.Element.classed(c, b);
	};


	//Tooltips, they are attachable to any graphic structure, even within themselves
	//@attr: parent, tiphtml, x, y, fill, stroke, stroke_width, fill_op, stroke_op
	function ToolTip(obj) {
		//Attributes------------------------------------------------------------
		this.ClassType = 'ToolTip';

		if (obj) {

			this.Parent = obj.parent || d3.select('body');
			this.X = obj.x || obj.parent.X || 0;
			this.Y = obj.y || obj.parent.Y || 0;
			this.Fill = obj.fill || 'white';
			this.Stroke = obj.stroke || 'black';
			this.StrokeWidth = obj.stroke_width || 1;
			this.Html = obj.tiphtml || '';
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		//appends div and sets transition
		this.Div = d3.select('body').append('div')
			.style('left', this.X + 'px')
			.style('top', this.Y + 'px')
			.style('opacity', 0)
			.style('position', 'absolute');
		this.Div.html(this.Html);

		if (gamevis.data.isStyleSourceCode()) {
			this.Div.style('background-color', this.Fill)
				.style('border-style', 'outset')
				.style('border-color', this.Stroke)
				.style('border-width', this.StrokeWidth);
		}
	}

	//Methods---------------------------------------------------------------
	ToolTip.prototype.transition = function () {
		return this.Div.transition();
	};

	ToolTip.prototype.on = function (e, func) {
		this.Parent.on(e, func);
		return this;
	};

	ToolTip.prototype.attr = function (attribute, value) {
		this.Div.attr(attribute, value);
		return this;
	};

	ToolTip.prototype.style = function (style, value) {
		this.Div.style(style, value);
		return this;
	};

	ToolTip.prototype.classed = function (cssClass, classBool) {
		this.Div.classed(cssClass, classBool);
		return this;
	};

	ToolTip.prototype.html = function (str) {
		return this.Div.html(str);
	};

	//Defines a circle dot token to mark something like a turning point, a tooltip, etc
	//@attr: canvas, x, y, radius, fill, stroke, stroke_width, fill_op, stroke_op
	function Dot(obj) {
		//Attributes----------------------------------------------------------------

		this.ClassType = 'Dot';

		if (obj) {
			this.Canvas = obj.canvas;

			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.Radius = obj.radius || 1;
			this.Fill = obj.fill || '#FFF';
			this.Stroke = obj.stroke || '#FFF';
			this.StrokeWidth = obj.stroke_width || 1;
			this.FillOpacity = obj.fill_op || 1.0;
			this.StrokeOpacity = obj.stroke_op || 1.0;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Element = null;

		return this.append();
	}

	//Methods------
	Dot.prototype.append = function () {
		var self = this;

		//Appending
		if (this.Canvas !== undefined) {
			this.Element = self.Canvas.append('circle')
				.attr('cx', this.X)
				.attr('cy', this.Y)
				.attr('r', this.Radius)
				.classed('dot-element', true);

			if (gamevis.data.isStyleSourceCode()) {
				this.Element.attr('fill', this.Fill)
					.attr('stroke', this.Stroke)
					.attr('stroke-width', this.StrokeWidth)
					.attr('fill-opacity', this.FillOpacity)
					.attr('stroke-opacity', this.StrokeOpacity);
			}
		}

		return self;
	};

	Dot.prototype.remove = function () {
		if (this.Element !== null) {
			this.Element.remove();
			this.Element = null;
		}
	};

	Dot.prototype.transition = function(){
		return this.Element.transition();
	};

	Dot.prototype.classed = function (c, b) {
		this.Element.classed(c, b);
		return this;
	};

	Dot.prototype.on = function (evnt, func) {
		this.Element.on(evnt, func);
		return this;
	};

	Dot.prototype.attr = function (attr, value) {
		this.Element.attr(attr, value);
		return this;
	};

	Dot.prototype.style = function (style, value) {
		this.Element.style(style, value);
		return this;
	};

	Dot.prototype.get = function () {
		return this.Element;
	};

	//Status Token class and color literals
	//to change the colors of the statuses modify this code;
	var TokenColors = [];
	TokenColors.Death = [];
	TokenColors.Frag = [];
	TokenColors.Score = [];

	TokenColors.Death.Fill = '#E61820';
	TokenColors.Death.Stroke = '#9D4257';
	TokenColors.Death.Text = 'death';
	TokenColors.Frag.Fill = '#4BB36C';
	TokenColors.Frag.Stroke = '#36814D';
	TokenColors.Frag.Text = 'frag';
	TokenColors.Score.Fill = '#EBCC28';
	TokenColors.Score.Stroke = '#D69C0A';
	TokenColors.Score.Text = 'gold';

	//Status token, an ellipse rect with text and color
	//@attr: canvas, type, x, y, rx, ry, fill, stroke, stroke_width, fill_op, stroke_op
	function StatusToken(obj) {
		//Attributes----------------------------------------------------------------

		this.ClassType = 'StatusToken';

		if (obj) {
			this.Canvas = obj.canvas;
			this.Type = obj.type;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.RX = obj.rx || 35;
			this.RY = obj.ry || 30;
			this.Fill = obj.fill || 'black';
			this.Stroke = obj.stroke || 'black';
			this.StrokeWidth = obj.stroke_width || 5.0;
			this.FillOpacity = obj.fill_op || 0.85;
			this.StrokeOpacity = obj.stroke_op || 0.9;
			this.TextFontFamily = obj.text_font_family || 'Sans-serif';
			this.TextFontSize = obj.text_font_size || 18;
			this.TextFill = obj.text_fill || 'white';
			this.TextFillOpacity = obj.text_fill_op || 1;
			this.TextStroke = obj.text_stroke || 'white';
			this.TextStrokeWidth = obj.stroke_width || 0;
			this.TextStrokeOpacity = obj.text_stroke_op || 1;
			this.Transition = obj.transition;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.TokenElement = null;
		this.TText = '';

		if (gamevis.data.isStyleSourceCSS()) {
			switch (this.Type) {
			case 'death':
				this.Fill = TokenColors.Death.Fill;
				this.Stroke = TokenColors.Death.Stroke;
				this.TText = TokenColors.Death.Text;
				break;

			case 'frag':
				this.Fill = TokenColors.Frag.Fill;
				this.Stroke = TokenColors.Frag.Stroke;
				this.TText = TokenColors.Frag.Text;
				break;

			case 'gold':
				this.Fill = TokenColors.Score.Fill;
				this.Stroke = TokenColors.Score.Stroke;
				this.TText = TokenColors.Score.Text;
			}
		}
	}

	//Methods----------
	StatusToken.prototype.append = function () {
		var self = this;

		if (this.Canvas !== undefined && this.TokenElement === null) {
			//magic happens (appends ellipse and text)
			var x = self.X;
			var y = self.Y;
			var ry = self.RY;
			self.TokenElement = self.Canvas.append('g')
				.classed('status-token', true);

			var tokenkind = 'status-token-' + self.Type;
			var ellipse = self.TokenElement.append('ellipse')
				.attr('cx', x)
				.attr('cy', y)
				.attr('rx', self.RX)
				.attr('ry', self.RY)
				.classed(tokenkind, true);


			self.TokenElement.classed('status-token', true);

			var text = self.TokenElement.append('text')
				.text(self.TText)
				.attr('transform', function () {
					return 'translate(' + x + ', ' + (y + ry / 5) + ')';
				})
				.classed('status-token-text', true);

			if (gamevis.data.isStyleSourceCode()) {
				//Token Styling
				ellipse.style('fill', self.Fill)
					.style('stroke', self.Stroke)
					.style('stroke-width', self.StrokeWidth)
					.style('fill-opacity', self.FillOpacity)
					.style('stroke-opacity', self.StrokeOpacity);

				//Text Styling
				text.style('font-family', self.TextFontFamily)
					.style('font-size', self.TextFontSize)
					.style('fill', self.TextFill)
					.style('fill-opacity', self.TextFillOpacity)
					.style('stroke', self.TextStroke)
					.style('stroke-width', self.TextStrokeWidth)
					.style('stroke-opacity', self.TextStrokeOpacity)
					.style('text-anchor', 'middle');
			}

			if(self.Transition === undefined){
				//erases attributes
				self.transition().attr('rx', 0)
				.attr('ry', 0)
				.duration(0)
				.delay(0);

				//sets real transition
				self.transition().attr('rx', self.RX)
				.attr('ry', self.RY)
				.duration(800	)
				.delay(80)
				.ease('bounce-in');
			}
			else {
				self.transition().call(self.Transition);
			}

		} else
		if (gamevis.data.DEBUG === true)
			console.log('Error, token ellipse is null');

		return self;
	};

	StatusToken.prototype.remove = function () {
		if (this.TokenElement !== null) {
			this.TokenElement.remove();
			this.TokenElement = null;
		}
	};

	StatusToken.prototype.reappend = function () {
		this.remove();
		this.append();
	};

	StatusToken.prototype.get = function () {
		return this.TokenElement;
	};

	StatusToken.prototype.transition = function () {
		return this.TokenElement.selectAll('ellipse').transition();
	};

	//Time Axis Class to handle "data over time" graphs
	//@attr: canvas, y, orientation, scale, nticks
	function TimeAxis(obj) {
		//Attributes------------------------------------------------------
		if (obj) {
			this.Canvas = obj.canvas;
			this.Scale = obj.scale || d3.scale.linear()
				.domain([0, 100])
				.range([0, 320]);
			this.Orient = obj.orientation || 'bottom';
			this.Y = obj.y || 0;
			this.Ticks = obj.tickvalues;
			this.NTicks = obj.nticks;
			this.Stroke = obj.stroke || 'black';
			this.StrokeWidth = obj.stroke_width || 1;
			this.StrokeOpacity = obj.stroke_op || 1;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Axis = null;
		this.Group = null;
	}

	//Methods----------------
	TimeAxis.prototype.append = function () {
		var self = this;

		//creates axis here
		self.Axis = d3.svg.axis()
			.scale(self.Scale)
			.orient(self.Orient)
			.tickSize(0); //Assign axis to just created scaled axis
		if (self.NTicks)
			self.Axis.ticks(self.NTicks);
		else if (self.Ticks)
			self.Axis.tickValues(self.Ticks);

		if (self.Canvas !== undefined) {
			//appending happens here
			this.Group = self.Canvas.append('g')
				.classed('time-axis', true)
				.call(self.Axis)
				.attr('transform', function () {
					return ('translate(0, ' + self.Y + ')');
				});

			if (gamevis.data.isStyleSourceCode()) {
				this.Group.style('stroke-width', this.StrokeWidth)
					.style('stroke', this.Stroke)
					.style('stroke-opacity', this.StrokeOpacity);
			}
		}

		return self;
	};

	TimeAxis.prototype.remove = function () {
		if (this.Axis !== null) {
			this.Axis.remove();
			this.Axis = null;
		}
	};

	TimeAxis.prototype.reappend = function () {
		this.remove();
		this.append();
	};

	TimeAxis.prototype.get = function () {
		return this.Group;
	};

	TimeAxis.prototype.classed = function (c, b) {
		return this.Group.classed(c, b);
	};

	TimeAxis.prototype.transition = function () {
		return this.Group.transition();
	};

	//Line Graph
	//@attr: canvas, match, type, x, y, scaleX, scaleY
	function ComparisonGraphLine(obj) {

		//Attributes-------------------------------------------------
		if (obj) {
			this.Canvas = obj.canvas;

			this.Match = obj.match;
			this.Type = obj.type; //Gold, Kills or XP
			this.X = obj.x;
			this.Y = obj.y;
			this.ScaleX = obj.scaleX;
			this.ScaleY = obj.scaleY;
			this.Ticks = obj.ticks || false;
			this.TickRadius = obj.tick_radius || 4;
			this.HalfHeight = this.Canvas.Height/2;
			this.ToolTips = obj.tooltips || null;
			this.Transition = obj.transition || false;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Lines = [];
		this.Element = null;
		this.LineGroup = null;
	}

	//Methods-----------------

	//Iterates through teams and gets interest points over time
	ComparisonGraphLine.prototype.build = function () {
		var self = this;

		//build lines
		for (var i = 0; i < self.Match.EndTime - 1; i++) {

			var v = [self.ScaleX(i), self.ScaleY(self.Match.getDifference(i,
				self
				.Type)), self.ScaleX(i + 1), self.ScaleY(self.Match.getDifference(
				i + 1, self.Type))];
			self.Lines.push(v);
		}
	};

	ComparisonGraphLine.prototype.append = function () {
		var self = this;

		self.Element = self.Canvas.append('g')
			.classed('comparison-graph-line', true)
			.attr('transform', function () {
				return ('translate(' + self.X + ', ' + self.Y + ')');
			});

		self.LineGroup = self.Element.append('g')
			.classed('line-graph-line-group', true);

		if (self.Ticks) {
			self.Ticks = self.Element.append('g')
				.classed('line-graph-tick-group', true);
		}

		//also defines default transitions, if the user wants to override them its ok
		for (var i in self.Lines) {
			self.LineGroup.append('line')
				.attr('x1', self.Lines[i][0])
				.attr('y1', self.ScaleY(0))
				.attr('x2', self.Lines[i][2])
				.attr('y2', self.ScaleY(0))
				.classed('line-graph-segment', true)
				.transition()
				.duration(500)
				.delay(300)
				.ease('quad-out')
				.attr('y1', self.Lines[i][1])
				.attr('y2', self.Lines[i][3]);

			//attach ticks
			if (self.Ticks) {
				var tick = new Dot({
					canvas: self.Ticks,
					x: self.Lines[i][0],
					y: self.ScaleY(0),
					radius: 1
				}).classed('line-graph-tick', true)
				.transition()
				.duration(500)
				.delay(300)
				.ease('quad-out')
				.attr('cy', self.Lines[i][1])
				.transition()
				.delay(800)
				.duration(600)
				.ease('bounce-in')
				.attr('r', this.TickRadius);
			}
		}
		//attach last tick
		if (self.Ticks) {
			var ml = self.Match.EndTime - 2;
			var tick = new Dot({
				canvas: self.Ticks,
				x: self.Lines[ml][2],
				y: self.ScaleY(0),
				radius: 1
			}).classed('line-graph-tick', true)
			.transition()
			.duration(500)
			.delay(300)
			.ease('quad-out')
			.attr('cy', self.Lines[ml][3])
			.transition()
			.delay(800)
			.duration(600)
			.ease('bounce-in')
			.attr('r', this.TickRadius);
		}

		//appends time axis
		var axis = new TimeAxis({
			canvas: self.Element,
			y: self.HalfHeight,
			orientation: 'bottom',
			scale: self.ScaleX,
			nticks: 5
		});
		axis.append();

		//Text and some other stuff
		var mx = self.X;
		var my = self.Y + 16;
		var textTitle = self.Element.append('text')
			.text('Line comparison graph: ' + self.Type)
			.classed('line-graph-title', true)
			.attr('transform', function () {
				return 'translate(' + mx + ', ' + my + ')';
			});
		mx = self.Canvas.Width / 2 + self.X;
		my = self.Y + 64;
		var textTeam1 = self.Element.append('text')
			.text('Team ' + self.Match.Team[0].Name)
			.classed('comparison-graph-text', true)
			.attr('transform', function () {
				return 'translate(' + mx + ', ' + my + ')';
			});

		my = self.Canvas.Height - 64 + self.Y;
		var textTeam2 = self.Element.append('text')
			.text('Team ' + self.Match.Team[1].Name)
			.classed('comparison-graph-text', true)
			.attr('transform', function () {
				return 'translate(' + self.Canvas.Width / 2 + ', ' + my + ')';
			});
	};

	ComparisonGraphLine.prototype.remove = function () {
		if (this.Element !== null) {
			this.Element.remove();
			this.Element = null;
			this.Lines = [];
		}
	};

	ComparisonGraphLine.prototype.get = function (component) {
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'lines':
		case 'line':
			return this.Element.selectAll('line');
		case 'ticks':
		case 'tick':
			return this.Ticks.selectAll('circle');
		case 'axis':
			return this.Element.selectAll('g').filter(function () {
				return d3.select(this).classed('time-axis');
			});
		}
		return this.Element;
	};

	//picks an array of htmls for tooltips
	//if an array of objects is passed then assume thats an array of ToolTip objects
	ComparisonGraphLine.prototype.toolTips = function (tooltip) {
		var self = this;
		if (tooltip === undefined) {
			//return the tooltips
			return this.ToolTips;
		}

		if (tooltip.constructor !== Array) {
			throw (
				'ERROR: Expected array as an argument in "ComparisonGraphLine.toolTip()".'
			);
		} else {
			self.Element.selectAll('circle').each(function (d, i) {
				var parent = d3.select(this);

				var px = 0;
				var py = 0;

				//attach tooltips if its an string or html
				if (typeof tooltip[0] !== 'object') {
					var tip = new ToolTip({
							parent: parent,
							tiphtml: tooltip[i],
							x: px,
							y: py
						}).classed('tooltip', true)
						.on('mouseover', function () {
							var matrix = this.getScreenCTM()
			                .translate(+this.getAttribute("cx"), +this.getAttribute("cy"));
							var px = window.pageXOffset + matrix.e + 'px';
							var py = window.pageYOffset + matrix.f - 16 + 'px';

							tip.transition()
								.style('opacity', 1);
							tip.style('left', px)
									.style('top', py);
						}).on('mouseout', function () {
							tip.transition()
								.style('opacity', 0)
								.style('left', 0)
								.style('top', 0);
						});
				} else {
					tooltip[i].Parent = parent;
					tooltip[i].X = px;
					tooltip[i].Y = py;
				}
			});
		}
	};

	ComparisonGraphLine.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};

	//Bar comparison graph
	//@attr: canvas, match, type, x, y, scaleX, scaleY
	function ComparisonGraphBar(obj) {

		//Attributes-----------------------------------------------------------------
		if (obj) {
			this.Canvas = obj.canvas;

			this.Match = obj.match;
			this.Type = obj.type;
			this.X = obj.x;
			this.Y = obj.y;
			this.ScaleX = obj.scaleX;
			this.ScaleY = obj.scaleY;
			this.HalfHeight = (obj.canvas.Height) / 2;
			this.ToolTips = obj.tooltips || false;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Bars = [];
		this.BarsGroup = null;
		this.Element = null;
	}

	//Methods-------------
	//Iterates through teams and gets interest points over time
	ComparisonGraphBar.prototype.build = function () {
		var barWidth = (this.ScaleX(1) - this.ScaleX(0));
		for (var i = 0; i < this.Match.EndTime; i++) {
			//value = [x, y, width, height]
			var value = [this.ScaleX(i), this.HalfHeight, barWidth, this.Match
    .getDifference(
					i, this.Type) * this.HalfHeight / 10
   ];
			this.Bars.push(value);
		}
	};

	ComparisonGraphBar.prototype.append = function () {
		var self = this;
		var mx = 0;
		var my = 0;

		//adds the group element
		self.Element = self.Canvas.append('g')
			.classed('comparison-graph-bar', true)
			.attr('transform', function () {
				return ('translate(' + self.X + ', ' + self.Y + ')');
			});
		self.BarsGroup = self.Element.append('g')
			.classed('comparison-graph-bar-group', true);

		//adds the bars
		for (var i in self.Bars) {
			var tbar = self.Bars[i];
			var fill = 'black';
			if (tbar[3] < 0)
				fill = 'red';
			else
				fill = 'green';

			var bGraph = new Bar({
				canvas: self.BarsGroup,
				x: tbar[0],
				y: tbar[1],
				width: tbar[2],
				height: tbar[3],
				fill: fill
			});
			bGraph.append();
		}

		//adds the informative text
		for (i in self.Bars) {
			var tbar = self.Bars[i];
			//value to fix text position
			var val = tbar[3] < 0 ? 0 : tbar[2]/2;
			mx = tbar[0] + val;
			if (tbar[3] > 0)
				my = self.HalfHeight - tbar[3] - 4;
			else
				my = self.HalfHeight - tbar[3] + 16;

			var mtrans = 'translate(' + mx + ', ' + my + ')';
			if (self.Match.getDifference(i, self.Type) !== 0) {
				var infoT = self.Element.append('text')
					.classed('bar-info-text', true)
					.text(self.Match.getDifference(i, self.Type))
					.style('text-anchor', 'middle')
					.attr('transform', mtrans)
					.style('fill-opacity', 0)
					.transition()
					.delay(800)
					.duration(500)
					.style('fill-opacity', 1);
			}
		}

		//appends time axis
		var axis = new TimeAxis({
			canvas: self.Element,
			y: self.HalfHeight,
			orientation: 'bottom',
			scale: self.ScaleX,
			nticks: 5
		});
		axis.append();

		//Text and some other stuff
		mx = self.X;
		my = self.Y + 16;
		var textTitle = self.Element.append('text')
			.text('Bar comparison graph: ' + self.Type)
			.classed('bar-graph-title', true)
			.attr('transform', function () {

				return 'translate(' + mx + ', ' + my + ')';
			});

		mx = self.Canvas.Width / 2 + self.X;
		my = 64 + self.Y;
		var textTeam1 = self.Element.append('text')
			.text('Team ' + self.Match.Team[0].Name)
			.classed('comparison-graph-text', true)
			.attr('transform', function () {
				return 'translate(' + mx + ', ' + my + ')';
			});

		y = self.Canvas.Height - 64 + self.Y;
		var textTeam2 = self.Element.append('text')
			.text('Team ' + self.Match.Team[1].Name)
			.classed('comparison-graph-text', true)
			.attr('transform', function () {
				return 'translate(' + self.Canvas.Width / 2 + ', ' + y + ')';
			});
	};

	ComparisonGraphBar.prototype.remove = function () {
		this.Bars = [];
		this.BarsGroup.remove();
		this.BarsGroup = null;
	};

	ComparisonGraphBar.prototype.get = function (component) {
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'bar':
		case 'bars':
			return this.BarsGroup.selectAll('rect');
		case 'tick':
		case 'ticks':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('bar-info-text');
			});
		case 'axis':
			return this.Element.selectAll('g').filter(function () {
				return d3.select(this).classed('time-axis');
			});
		}

		return this.Element;
	};

	ComparisonGraphBar.prototype.toolTips = function (tooltip) {
		var self = this;
		if (tooltip === undefined) {
			//return the tooltips
			return this.ToolTips;
		}

		if (tooltip.constructor !== Array) {
			throw (
				'ERROR: Expected array as an argument in "ComparisonGraphLine.toolTip()".'
			);
		} else {
			self.get('bars')
				.each(function (d, i) {
					var parent = d3.select(this);
					var px = self.Bars[i][0];
					var py = self.Bars[i][1];

					//attach tooltips if its an string or html
					if (typeof tooltip[0] !== 'object') {
						var tip = new ToolTip({
								parent: parent,
								tiphtml: tooltip[i],
								x: px,
								y: py
							}).classed('tooltip', true)
							.on('mouseover', function () {
								tip.transition()
									.style('opacity', 1);
							}).on('mouseout', function () {
								tip.transition()
									.style('opacity', 0);
							});
					} else {
						tooltip[i].Parent = parent;
						tooltip[i].X = px;
						tooltip[i].Y = py;
					}
				});
		}
	};

	ComparisonGraphBar.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};

	//graph that displays detailed team info
	//@attr: canvas, team, x, y
	function TeamDetailGraph(obj) { //display team name, list of players and their attributes

		//Attributes---------------------------------------------------------
		if (obj) {
			this.Canvas = obj.canvas;

			this.Team = obj.team;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Element = null;
	}

	//Methods-----------------
	TeamDetailGraph.prototype.append = function () {
		var self = this;
		var res = {w: self.Canvas.Width, h: self.Canvas.Height};

		self.Element = self.Canvas.append('g').classed('team-detail-graph',
				true)
			.attr('transform', function () {
				return 'translate(' + self.X + ', ' + self.Y + ')';
			});

		self.Element.append('text')
			.text('Team ' + self.Team.Name)
			.classed('team-graph-title', true)
			.attr('transform', function () {
				return 'translate(' + res.w / 40 + ', ' + res.h / 40 + ')';
			});

		//internal functions to help appending
		function getTranslate(i) {
			var px = res.w / 20;
			if (i % 2 !== 0) {
				px += canvas.Width / 2;
			}
			var py = (Math.floor(i / 2) + 1) * res.h / 4;
			return 'translate(' + px + ', ' + py + ')';
		}

		function textTranslate(y) {
			return 'translate(32, ' + y + ')';
		}

		for (var i in self.Team.Players) {
			//creates new group to display player info
			var pinfo = self.Element.append('g').classed('team-player-info',
					true)
				.attr('transform', getTranslate(i));
			var mplayer = self.Team.Players[i];

			var title = pinfo.append('text')
				.classed('team-player-info-title', true)
				.text(mplayer.Name)
				.attr('transform', textTranslate(4));
			title.append('tspan')
				.classed('team-player-info', true)
				.text('Total Gold: ' + mplayer.TotalGold)
				.attr('x', '1em')
				.attr('dy', '1.1em')
				.attr('transform', textTranslate(20))
				.append('tspan')
				.classed('team-player-info', true)
				.text('Total XP: ' + mplayer.TotalXP)
				.attr('x', '1em')
				.attr('dy', '1.1em')
				.attr('transform', textTranslate(36))
				.append('tspan')
				.classed('team-player-info', true)
				.text('Level: ' + mplayer.Level)
				.attr('x', '1em')
				.attr('dy', '1.1em')
				.attr('transform', textTranslate(52))
				.append('tspan')
				.classed('team-player-info', true)
				.text('Nation: ' + mplayer.Nation)
				.attr('x', '1em')
				.attr('dy', '1.1em')
				.attr('transform', textTranslate(68));
		}

	};

	TeamDetailGraph.prototype.remove = function () {
		this.Element.remove();
		this.Element = null;
	};

	TeamDetailGraph.prototype.get = function (component) {
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'player_name':
		case 'player_names':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info-title');
			});
		case 'player_infos':
		case 'player_info':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info');
			});
		}

		return this.Element;
	};

	TeamDetailGraph.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};

	//Graph that displays detailed player-match info
	//@attr: canvas, match, player, scale, x, y
	function PlayerMatchGraph(obj) {
		//Attributes---------------------------------------------------------------
		if (obj) {
			this.Canvas = obj.canvas;

			this.Player = obj.player;
			this.Scale = obj.scale;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.ToolTips = obj.tooltips || false;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Element = null;
		this.StatusTokensGroup = null;
	}

	//Methods---------------
	PlayerMatchGraph.prototype.append = function () {
		var self = this;

		var gX = self.X;
		var gY = self.Y;
		var res = {w: self.Canvas.Width, h: self.Canvas.Height};

		self.Element = self.Canvas.append('g')
			.classed('player-match-graph', true)
			.attr('transform', function () {
				return 'translate(' + gX + ', ' + gY + ')';
			});

		self.Element.append('text').text('Player Match History')
			.classed('player-match-title', true)
			.attr('transform', function () {
				return 'translate(4, 32)';
			});

		self.Element.append('text').text(self.Player.Name)
			.classed('player-match-name', true)
			.attr('transform', function () {
				return 'translate(32, 96)';
			});

		//Append status tokens
		self.StatusTokensGroup = self.Element.append('g')
			.classed('status-tokens-group', true);

		for (var i in self.Player.Status) {
			var status = self.Player.Status[i];
			var tx = self.Scale(status[0]);
			var ty = 0;
			var rx = res.h / 15;
			var ry = res.h / 18;
			switch (status[1]) {
			case 'frag':
				ty = ry * res.h / 200 * 1 - res.h / 6;
				break;
			case 'gold':
				ty = ry * res.h / 200 * 2.5 - res.h / 6;
				break;
			case 'death':
				ty = ry * res.h / 200 * 4 - res.h / 6;
				break;
			}
			if (gamevis.data.DEBUG === true)
				console.log('Status: ' + status);
			var token = new StatusToken({
				canvas: self.StatusTokensGroup,
				type: status[1],
				x: tx,
				y: ty,
				rx: rx,
				ry: ry
			});
			token.append();
		}

		//put status token group on a feasible position
		self.StatusTokensGroup.attr('transform', function () {
			var stgX = 0;
			var stgY = gY + res.h / 2;

			return 'translate(' + stgX + ', ' + stgY + ' )';
		});

		//put the axis
		var axis = new TimeAxis({
			canvas: self.Element,
			y: gY + res.h - res.h / 20,
			orientation: 'bottom',
			scale: self.Scale,
			nticks: 5
		});
		axis.append();
	};

	PlayerMatchGraph.prototype.remove = function () {
		this.Element.remove();
		this.Element = null;
	};

	PlayerMatchGraph.prototype.get = function (component) {
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'player_name':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('player-match-name');
			});
		case 'tokens':
		case 'token':
		case 'status_tokens':
		case 'status_token':
			return this.StatusTokensGroup.selectAll('ellipse');
		case 'axis':
			return this.Element.selectAll('g').filter(function () {
				return d3.select(this).classed('time-axis');
			});
		}
		return this.Element;
	};

	PlayerMatchGraph.prototype.toolTips = function (tooltip) {
		var self = this;
		if (tooltip === undefined) {
			//return the tooltips
			return this.ToolTips;
		}

		if (tooltip.constructor !== Array) {
			throw ('ERROR: Expected array as an argument in' +
				'"ComparisonGraphLine.toolTip()".');
		} else {
			self.get('tokens')
				.each(function (d, i) {
					var res = {w: self.Canvas.Width, h: self.Canvas.Height};
					var parent = d3.select(this);
					var px = parseInt(d3.select(this).attr('cx')) + parseInt(d3.select(
						this).attr('rx') / 2);
					var py = parseInt(d3.select(this).attr('cy')) + res.h / 2;

					//attach tooltips if its an string or html
					if (typeof tooltip[0] !== 'object') {
						var tip = new ToolTip({
								parent: parent,
								tiphtml: tooltip[i],
								x: px,
								y: py
							}).classed('tooltip', true)
							.on('mouseover', function () {
								tip.transition()
									.style('opacity', 1);
							}).on('mouseout', function () {
								tip.transition()
									.style('opacity', 0);
							});
					} else {
						tooltip[i].Parent = parent;
						tooltip[i].X = px;
						tooltip[i].Y = py;
					}
				});
		}
	};

	PlayerMatchGraph.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};

	//a graph that shows a list of resources and an icon
	//@attrs: canvas, team, parent_resource, resource, scaleX, scaleY, x, y
	function ResourceListGraph(obj) {
		//Attributes------------
		this.ClassType = 'ResourceListGraph';

		if (obj) {
			this.Canvas = obj.canvas;

			this.Team = obj.team;
			this.ScaleX = obj.scaleX;
			this.ScaleY = obj.scaleY;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.ToolTips = obj.tooltips || false;

			//parent resource, if any (like a player thumbnail or so. Usualy a single resource)
			this.ParentResource = obj.parent_resource || '';
			//interest resource, mandatory (the actual resource, like items, etc. Usualy a list)
			this.InterestResource = obj.resource || '';
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Element = null;
	}

	//Methods------------------
	ResourceListGraph.prototype.setInterest = function (interest, parent) {
		this.ParentResource = parent;
		this.InterestResource = interest;
	};
	ResourceListGraph.prototype.append = function () {
		var self = this;

		self.Element = self.Canvas.append('g')
			.classed('team-resource-group', true)
			.attr('transform', function () {
				return 'translate(' + self.X + ',' + self.Y + ')';
			});
		var nPlayers = self.Team.Players.length;
		for (var i in self.Team.Players) { //loops through players to show resources
			var resGroup = self.Element.append('g')
				.classed('player-resource-group', true)
				.attr('transform', function () {
					var sx = self.ScaleX(0.1);
					var sy = self.ScaleY(parseInt(i) + 1);
					console.log();
					return 'translate(' + sx + ',' + sy + ')';
				});
			//appends player name text
			var ptext = resGroup.append('text')
				.classed('team-player-info-title', true)
				.text(self.Team.Players[i].Name);
			//appends player parent resource
			if (self.ParentResource !== undefined) {
				var src = self.Team.Players[i].Resources[self.ParentResource].IconURI;
				var img = resGroup.append('image')
					.classed('parent-resource', true)
					.attr('width', self.ScaleX(0.4))
					.attr('height', self.ScaleY(0.4))
					.attr('y', 4)
					.attr('xlink:href', src);
			}
			//appends interest resources accordingly if no parent resource is set
			var interestGroup = resGroup.append('g')
				.classed('interest-resource-group', true)
				.attr('transform', function () {
					var sx = self.ParentResource === undefined ? self.ScaleX(-0.6) :
						self.ScaleX(
							0.2);
					return 'translate(' + sx + ',0)';
				});
			for (var j in self.Team.Players[i].Resources[self.InterestResource]) {
				var src = self.Team.Players[i].Resources[self.InterestResource][j]
					.IconURI;
				var img = interestGroup.append('image')
					.classed('interest-resource', true)
					.attr('width', self.ScaleX(0.4))
					.attr('height', self.ScaleY(0.4))
					.attr('x', self.ScaleX(j / 2))
					.attr('y', 4)
					.attr('xlink:href', src);
			}
		}
	};

	ResourceListGraph.prototype.remove = function () {
		this.Element.remove();
	};

	ResourceListGraph.prototype.get = function (component) {
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'parent':
		case 'parent-resource':
		case 'parent_resource':
			var ret = this.Element.selectAll('image').filter(function () {
				return d3.select(this).classed('parent-resource');
			});
			return ret;
		case 'interest':
		case 'resource':
		case 'resources':
		case 'interest-resource':
		case 'interest-resources':
		case 'interest_resource':
		case 'interest_resources':
		case 'child':
		case 'childrem':
			return this.Element.selectAll('image').filter(function () {
				return d3.select(this).classed('interest-resource');
			});
		case 'name':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info');
			});
		}
		return this.Element;
	};

	ResourceListGraph.prototype.toolTips = function (component, tooltip) {
		var self = this;
		if (!component || (typeof component !== 'string'))
			throw (
				'ERROR: Component must be defined for toolTips method of a Resource List Graph!'
			);
		if (!tooltip) {
			//return the tooltips
			return this.ToolTips;
		}

		if (tooltip.constructor !== Array) {
			throw ('ERROR: Expected array as an argument in' +
				'"ComparisonGraphLine.toolTip()".');
		} else {
			self.get(component).each(function (d, i) {
				var parent = d3.select(this);
				var rect = this.getBoundingClientRect();
				var matrix = this.getScreenCTM()
								.translate(+this.getAttribute("cx"), +this.getAttribute("cy"));
				var px = window.pageXOffset + matrix.e + 'px';
				var py = window.pageYOffset + matrix.f - 16 + 'px';

				//attach tooltips if its an string or html
				if (typeof tooltip[0] !== 'object') {
					var tip = new ToolTip({
							parent: parent,
							tiphtml: tooltip[i],
							x: px,
							y: py
						}).classed('tooltip', true)
						.on('mouseover', function () {
							var matrix = this.getScreenCTM()
			                .translate(+this.getAttribute("cx"), +this.getAttribute("cy"));
							var px = window.pageXOffset + matrix.e + 'px';
							var py = window.pageYOffset + matrix.f - 16 + 'px';

							tip.transition()
								.style('opacity', 1);
							tip.style('left', px)
									.style('top', py);
						}).on('mouseout', function () {
							tip.transition()
								.style('opacity', 0);
						});
				} else {
					tooltip[i].Parent = parent;
					tooltip[i].X = px;
					tooltip[i].Y = py;
				}
			});
		}
	};

	ResourceListGraph.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};

	//Ending match results graph
	//@attr: canvas, match, scaleX, scaleY, x, y
	function MatchResultsGraph(obj) {
		//Attributes
		this.ClassType = 'MatchResultsGraph';

		if (obj) {
			this.Canvas = obj.canvas;

			this.Match = obj.match;
			this.ScaleX = obj.scaleX;
			this.ScaleY = obj.scaleY;
			this.X = obj.x || 0;
			this.Y = obj.y || 0;
			this.PLayerNameLength = obj.player_name_length || 24;
		} else if (DEBUG)
			throw ': Argument object not defined in ' + this.ClassType;

		this.Element = null;
	}

	//Methods----------
	MatchResultsGraph.prototype.append = function () {
		var self = this;
		//append results group
		self.Element = self.Canvas.append('g')
			.classed('end-results', true)
			.attr('transform', function () {
				return 'translate(' + self.X + ',' + self.Y + ')';
			});
		//appends team info and data
		var teamGroup = self.Element.selectAll('g')
			.data([self.Match.Team[0], self.Match.Team[1]])
			.enter()
			.append('g')
			.classed('team-result-group', true)
			.attr('transform', function (d, i) {
				var y = i === 0 ? 0 : 3.5;
				return 'translate(' + self.ScaleX(0) + ',' + self.ScaleY(y) +
					')';
			});

		teamGroup.append('text')
			.classed('team-player-info-title', true)
			.text(function (d) {
				return d.Name + ' Team -';
			})
			.append('tspan')
			.classed('team-player-info', true)
			.text('Average Level:')
			.attr('x', '10em')
			.append('tspan')
			.classed('team-player-info-value', true)
			.text(function (d, i) {
				return self.Match.Team[i].AverageLevel;
			})
			.attr('dx', '1em')
			.append('tspan')
			.classed('team-player-info', true)
			.text('Gold:')
			.attr('x', '22em')
			.append('tspan')
			.classed('team-player-info-value', true)
			.text(function (d, i) {
				return self.Match.Team[i].Gold;
			})
			.attr('dx', '1em')
			.append('tspan')
			.classed('team-player-info', true)
			.text('Kills:')
			.attr('x', '30em')
			.append('tspan')
			.classed('team-player-info-value', true)
			.text(function (d, i) {
				return self.Match.Team[i].NumKills;
			})
			.attr('dx', '1em');

		//append player names (and thumbnail if available TODO) and group of info
		var texts = teamGroup.append('text').attr('transform', function () {
			return 'translate(12,0)';
		});
		var names = texts.selectAll('text')
			.data(function (d, i) {
				return self.Match.Team[i].Players;
			})
			.enter()
			.append('tspan')
			.classed('team-player-info-value', true)
			.classed('player-name', true)
			.text(function (d, i) {
				var str = d.Name.substr(0, self.PLayerNameLength);
				if (d.Name.length > self.PLayerNameLength)
					str += '...';
				return str;
			})
			.attr('dy', '3em')
			.attr('x', '0');

		//append info requested in a text fashion
		names.append('tspan').text(function (d) {
			return 'Gold: ' + d.CurrentGold;
		}).attr('x', '18em');
		names.append('tspan').text(function (d) {
			return 'Level: ' + d.Level;
		}).attr('x', '26em');
		names.append('tspan').text(function (d) {
			return 'K:  ' + d.CurrentKills;
		}).attr('x', '36em');
		names.append('tspan').text(function (d) {
			return 'D: ' + d.CurrentDeaths;
		}).attr('x', '40em');
		names.append('tspan').text(function (d) {
			return 'A: ' + d.CurrentAssists;
		}).attr('x', '44em');

	};

	MatchResultsGraph.prototype.remove = function () {
		this.Element.remove();
	};

	MatchResultsGraph.prototype.get = function (component) {
		//TODO: this
		if (!component)
			return this.Element;
		component.toLowerCase();
		switch (component) {
		case 'team-name':
		case 'team_name':
		case 'team-names':
		case 'team_names':
			var ret = this.Element.selectAll('image').filter(function () {
				return d3.select(this).classed('parent-resource');
			});
			return ret;
		case 'average-level':
		case 'average-levels':
		case 'average_level':
		case 'average_levels':
			return this.Element.selectAll('g').filter(function () {
				return d3.select(this).classed('interest-resource-group');
			}).selectAll('image');
		case 'gold':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info');
			});
		case 'kills':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info');
			});
		case 'player':
		case 'players':
			return this.Element.selectAll('text').filter(function () {
				return d3.select(this).classed('team-player-info');
			});
		}
		return this.Element;
	};

	MatchResultsGraph.prototype.transition = function (component, transition) {
		if (component && transition)
			this.get(component).transition().call(transition);
		else if (component && !transition)
			return this.get(component).transition();

		return this.Element.transition();
	};


	gamevis.data = {
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

	gamevis.graphics = {
		//classes
		Bar: Bar,
		ToolTip: ToolTip,
		Dot: Dot,
		StatusToken: StatusToken,
		TimeAxis: TimeAxis,
		ComparisonGraphLine: ComparisonGraphLine,
		ComparisonGraphBar: ComparisonGraphBar,
		TeamDetailGraph: TeamDetailGraph,
		PlayerMatchGraph: PlayerMatchGraph,
		ResourceListGraph: ResourceListGraph,
		MatchResultsGraph: MatchResultsGraph
	};

	return gamevis;
});
