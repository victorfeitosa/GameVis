//*******************************************************************************************************************************************
//Game stuctures*****************************************************************************************************************************
//*******************************************************************************************************************************************

//Canvas class----------------------------------------------------
function Canvas(width, height, bgcolor, label) {
	
	var self = this; //self variable to maintain the class auto-reference
	
	self.Width = width;
	self.Height = height;
	self.BGColor = bgcolor;
	self.Label = label;
	self.SVGCanvas = null;
	self.ClassType = "Canvas";

	self.append = function () {
		//check missing stuff
		if (self.Width === undefined)
			self.Width = 640;
		if (self.Height === undefined)
			self.Height = 480;
		if (self.BGColor === undefined)
			self.BGColor = "0xAAAAAA";
		if (self.Label === undefined)
			self.Label = "Game Graph:";

		//actual appending
		if (self.SVGCanvas === null) {
			self.SVGCanvas = d3.select("body").append("svg")
				.classed("canvas", true)
				.attr("width", self.Width)
				.attr("height", self.Height)
				.style("padding", 20)
				.style("background-color", self.BGColor);
		}
	};

	self.remove = function () {
		if (self.SVGCanvas !== null)
			self.SVGCanvas.remove();
	};

	self.getCanvas = function () {
		return self.SVGCanvas;
	};
}

//Player Class-------------------------------------------------------------------------------------------------------------------------------
function Player(name, rank, team, nation, tgold, txp, level) {
	//Attributes------------------------------------------------------------
	
	var self = this; //self variable to maintain the class auto-reference
	
	//Global attributes
	self.Name = name;
	self.Rank = rank;
	self.Team = team;
	self.Nation = nation;
	self.TotalGold = tgold;
	self.TotalXP = txp;
	self.Level = level;
	self.ClassType = "Player";

	//Match attributes
	self.CurrentGold = 0;
	self.CurrentXP = 0;
	self.CurrentKills = 0;
	self.CurrentDeaths = 0;
	self.Status = []; //frag, death, gold

	//Methods------------------------------------------------------------------
	self.print = function () {
		console.log("Name: " + self.Name);
		console.log("Rank: " + self.Rank);
		console.log("Team: " + self.Team);
		console.log("Nation: " + self.Nation);
		console.log("Total Gold: " + self.TotalGold);
		console.log("Total XP: " + self.TotalXP);
	};

	self.addDeath = function (time) {
		self.CurrentDeaths++;
		self.CurrentGold -= 100 + time;
		self.TotalGold -= 100 + time;
		
		//reality check
		if(self.CurrentGold < 0)
			self.CurrentGold = 0;
		if(self.TotalGold < 0)
			self.TotalGold = 0;
			
		self.Status.push([time, "Death"]);
	};

	self.addGold = function (time, amount) {
		self.CurrentGold += amount;
		self.TotalGold += amount;
		self.Status.push([time, "Gold"]);
	};

	self.addXP = function (amount) {
		self.CurrentXP += amount;
		self.TotalXP += amount;
	};

	self.addKill = function (time) { //adds a kill, xp and gold and informs who was killed
		self.CurrentKills++;
		self.addXP(200);

		self.CurrentGold += 250;
		self.TotalGold += 250;

		self.Status.push([time, "Frag"]);
	};
}

//Team Class---------------------------------------------------------------------------------------------------------------------------------
function Team(name, rank, nation) {
	//Attributes-----------------------------------------------------------------
	
	var self = this;
	
	self.ClassType = "Team";
	
	//Team common attributes
	self.Name = name;
	self.Rank = rank;
	self.Nation = nation;

	//Team attributes calculated on-demand
	self.Players = [];
	self.Gold = 0;
	self.NumKills = 0;
	self.AverageLevel = 0;

	//Methods----------------------------------------------------------------------

	//Calculates the stuff
	self.getAverageLevel = function () {
		var n = 0;
		for (var i in self.Players) {
			n += self.Players[i].Level;
		}

		n /= Players.length;
		
		return n;
	};

	self.getKills = function () {
		var n = 0;
		for (var i in self.Players) {
			n += self.Players[i].CurrentKills;
		}

		self.NumKills = n;

		return n;
	};

	self.getDeaths = function () {
		var n = 0;
		for (var i in self.Players) {
			n += self.Players[i].CurrentDeaths;
		}

		return n;
	};

	self.getXP = function () {
		var n = 0;
		for (var i in self.Players) {
			n += self.Players[i].CurrentXP;
		}

		return n;
	};

	self.getGold = function () {
		var n = 0;
		for (var i in self.Players) {
			n += self.Players[i].CurrentGold;
		}

		self.Gold = n;

		return n;
	};

	//add/remove  Players
	self.addPlayer = function (player) {
		self.Players.push(player);
	};

	self.removePlayer = function (ppos) {
		self.Players.splice(ppos, 1);
	};

	self.print = function () {
		console.log("Team " + self.Name + " profile:");
		console.log("-Players: ");
		for (var i in self.Players) {
			console.log("Player[" + i + 1 + "]: " + self.Players[i].Name);
		}
		console.log("-XP: " + self.getXP());
		console.log("-Gold: " + self.getGold());
	};
}

//Match Class--------------------------------------------------------------------------------------------------------------------------------
function Match(team1, team2, endtime) {
	//Attributes
	
	var self = this;
	
	self.ClassType = "Match";

	self.Team1 = team1;
	self.Team2 = team2;

	self.CurrentTime = 0;
	self.EndTime = endtime;

	self.GoldDifference = [];
	self.XPDifference = [];
	self.KillDifference = [];

	//Methods

	//init match, must be used before stuff gets computed
	self.init = function () {
		if (self.EndTime > 0) {
			//init difference arrays and player time array
			for (var i = 0; i < self.EndTime; i++) {
				self.GoldDifference.push(0);
				self.KillDifference.push(0);
				self.XPDifference.push(0);
			}
		}
	};

	//update stuff from teams and players
	self.addPlayerKill = function (killerTeam, victimTeam, killer, victim) {

		if ((killer.ClassType === "Player" && victim.ClassType === "Player") && (killerTeam.ClassType === "Team" && victimTeam.ClassType === "Team") && self.CurrentTime < self.EndTime) {
			killer.addKill(self.CurrentTime);
			victim.addDeath(self.CurrentTime);
			killerTeam.getKills();
			victimTeam.getDeaths();

		}
	};

	self.addPlayerGold = function (team, player, amount) {
		if (self.CurrentTime < self.EndTime) {
			player.addGold(self.CurrentTime, amount);
			team.getGold();
		}
	};

	self.addPlayerXP = function (team, player, amount) {
		if (self.CurrentTime < self.EndTime) {
			player.addXP(amount);
			team.getXP();
		}
	};

	self.getMatchTime = function (time) {
		return self.CurrentTime;
	};

	//return differences according to time
	self.calculateDifference = function (time, what) {
		var ret = 0;
		switch (what) {
		case "Gold":
			ret = self.Team2.getGold() - self.Team1.getGold();
			break;
		case "XP":
			ret = self.Team2.getXP() - self.Team1.getXP();
			break;
		case "Kills":
			ret = self.Team2.getKills() - self.Team1.getKills();
			break;
		}
		return ret;
	};

	self.getDifference = function (time, what) {
		var ret = 0;
		if (time <= self.EndTime) {
			self.calculateDifference(time, what);

			switch (what) {
			case "Gold":
				ret = self.GoldDifference[time];
				break;
			case "XP":
				ret = self.XPDifference[time];
				break;
			case "Kills":
				ret = self.KillDifference[time];
				break;
			}
		} else {
			console.log("Couldnt get difference of time " + time);
		}

		return ret;
	};

	//updates the match status adding kills, gold, etc
	self.update = function () {
		var time = self.CurrentTime;
		if (time <= self.EndTime) {
			self.GoldDifference.push(self.calculateDifference(time, "Gold"));
			self.XPDifference.push(self.calculateDifference(time, "XP"));
			self.KillDifference.push(self.calculateDifference(time, "Kills"));

			self.CurrentTime++;
		}
	};
}

//RealTimeMatch Class------------------------------------------------------------------------------------------------------------------------
function RealTimeMatch(team1, team2) {
	
	//Attributes-----------------------------------------------------------------------
	
	var self = this;
	
	self.Team1 = team1;
	self.Team2 = team2;
	
	self.CurrentTime = 0;
	self.Ended = false;
	
	self.GoldDifference = [];
	self.XPDifference = [];
	self.KillDifference = [];
	
	
	//Methods-------------------------------------------------------------------------
	
	self.getCurrentTime = function(){
		return self.CurrentTime;
	};
	
	self.update = function(){
		
	};
	
	
}


//*******************************************************************************************************************************************
//Drawgin-related Structures*****************************************************************************************************************
//*******************************************************************************************************************************************

//class to controll a bar graph
function Bar(canvas, x, y, width, height, fill, stroke, stroke_width, fill_op, stroke_op) {
	//attributes
	
	var self = this;
	
	self.ClassType = "Bar";

	//checks if it is a group or a canvas
	self.Canvas = canvas;
	if (self.Canvas.ClassType === "Canvas")
		self.Canvas = canvas.getCanvas();
	//--------------------------------------
	self.X = x;
	self.Y = y;
	self.Width = width;
	self.Height = height;
	self.Fill = fill;
	self.Stroke = stroke;
	self.StrokeWidth = stroke_width;
	self.FillOpacity = fill_op;
	self.StrokeOpacity = stroke_op;
	self.BarChart = null;

	self.append = function () {
		//Desfine default values-------------------------------------------------------------------------
		if (self.Fill === undefined) //if color is undefined, assign black
		{
			self.Fill = d3.rgb(60, 250, 60);
		}


		if (self.Stroke === undefined) //if color is undefined, assign black
		{
			self.Stroke = d3.rgb(0, 0, 0);
		}

		if (self.StrokeWidth === undefined) //if width is undefined, assign 0
		{
			self.StrokeWidth = 0;
		}

		if (self.FillOpacity === undefined) //if opacity is undefined, assign 1
		{
			self.FillOpacity = 1;
		}

		if (self.StrokeOpacity === undefined) //if opacity is undefined, assign 1
		{
			self.StrokeOpacity = 1;
		}

		//actual appending--------------------------------------------------------
		//appends in a canvas or group
		if (self.Canvas != undefined && self.BarChart === null) {
			var mx = self.X - self.Width / 2; //defines the bar X center
			var my = 0;
			if (self.Height < 0) {
				my = self.Y;
				self.Height *= -1;
			} else
				my = self.Y - self.Height;

			self.BarChart = self.Canvas.append("rect").classed("bar-element", true)	//set initial attributes
				.attr("transform", function () {
					return "translate(" + (mx) + ", " + (my) + ")";
				})
				.attr("width", self.Width)
				.attr("height", 0)
				.style("fill", d3.rgb(0,0,0))
				.style("stroke", self.Stroke)
				.style("stroke-width", self.StrokeWidth)
				.style("fill-opacity", self.FillOpacity)
				.style("stroke-opacity", self.StrokeOpacity);
				
				//applying height transition
				self.BarChart
					.transition()
					.attr("height", self.Height)
					.style("fill", self.Fill)
					.duration(1000)
					.delay(100);
		}
	};

	self.remove = function () {
		if (self.BarChart !== null) {
			self.BarChart.remove();
			self.BarChart = null;
		}
	};

	self.update = function () {//instead of removing and re-appending, just make a transition
		self.remove();
		self.append();
	};
}

//TODO: implement this
function ToolTip(canvas, parent, x, y, tip, fill, stroke, stroke_width, fill_op, stroke_op)
{
	//Attributes--------------------------------------------------------------------------
	
	var self = this;
	
	self.Canvas = canvas;
	self.Parent = parent;
	self.X = x;
	self.Y = y;
	self.Tip = tip;
	self.Radius = radius;
	self.Fill = fill;
	self.Stroke = stroke;
	self.StrokeWidth = stroke_width;
	self.FillOpacity = fill_op;
	self.StrokeOpacity = stroke_op;
}


//TODO: implement this
//Defines a line dot token to mark something like a turning point, a tooltip, etc
function Dot(canvas, x, y, radius, fill, stroke, stroke_width, fill_op, stroke_op)
{
	//Attributes--------------------------------------------------------------------------
	
	var self = this;
	
	self.Canvas = canvas;
	self.X = x;
	self.Y = y;
	self.Radius = radius;
	self.Fill = fill;
	self.Stroke = stroke;
	self.StrokeWidth = stroke_width;
	self.FillOpacity = fill_op;
	self.StrokeOpacity = stroke_op;
}

//Status Token class and color literals

//to change the colors of the statuses modify this code;
var TokenColors = [];
TokenColors.Death = []; TokenColors.Frag = []; TokenColors.Gold = [];

TokenColors.Death.Fill = "#E61820"; TokenColors.Death.Stroke = "#9D4257"; TokenColors.Death.Text = "Died";
TokenColors.Frag.Fill = "#4BB36C"; TokenColors.Frag.Stroke = "#36814D"; TokenColors.Frag.Text = "Frag";
TokenColors.Gold.Fill = "#EBCC28"; TokenColors.Gold.Stroke = "#D69C0A"; TokenColors.Gold.Text = "Gold";

function StatusToken(canvas, type, x, y) //an ellipse rect with text and color
{
	//Attributes----------------------------------------------------------------
	var self = this;
	
	self.ClassType = "StatusToken";
	self.Canvas = canvas;
	if (self.Canvas.ClassType === "Canvas")
		self.Canvas = canvas.getCanvas();
	self.Type = type;
	self.X = x;
	self.Y = y;
	self.RX = 35;
	self.RY = 30;
	self.Fill = d3.rgb(0, 0, 0);
	self.Stroke = d3.rgb(0, 0, 0);
	self.StrokeWidth = 5.0;
	self.FillOpacity = 0.85;
	self.StrokeOpacity = 0.9;
	self.Token = null;

	switch (self.Type) {
	case "Death":
		self.Fill = TokenColors.Death.Fill;
		self.Stroke = TokenColors.Death.Stroke;
		self.Text = TokenColors.Death.Text;
		break;

	case "Frag":
		self.Fill = TokenColors.Frag.Fill;
		self.Stroke = TokenColors.Frag.Stroke;
		self.Text = TokenColors.Frag.Text;
		break;

	case "Gold":
		self.Fill = TokenColors.Gold.Fill;
		self.Stroke = TokenColors.Gold.Stroke;
		self.Text = TokenColors.Gold.Text;
	}

	self.append = function () {
		if (self.Canvas != undefined && self.Token === null) {
			//magic happens (appends ellipse and text)
			var x = self.X;
			var y = self.Y;
			var ry = self.RY;
			self.Token = self.Canvas.append("g").attr("class", "status-token");

			self.Token.append("ellipse")
			.attr("transform", function () {
				return "translate(" + x + ", " + y + ")";
			})
			.attr("rx", self.RX)
			.attr("ry", self.RY)
			.style("fill", self.Fill)
			.style("stroke", self.Stroke)
			.style("stroke-width", self.StrokeWidth)
			.style("fill-opacity", self.FillOpacity)
			.style("stroke-opacity", self.StrokeOpacity);

			var text = self.Token.append("text")
				.text(self.Text)
				.attr("transform", function () {
					return "translate(" + x + ", " + (y + ry / 5) + ")";
				})
				.attr("font-family", "sans-serif")
				.attr("font-size", 18)
				.style("fill", "white")
				.style("text-anchor", "middle");
		} else
			console.log("Error, token ellipse is null");
	};

	self.remove = function () {
		if (self.Token !== null) {
			self.Token.remove();
			self.Token = null;
		}
	};

	self.update = function () {
		self.remove();
		self.append();
	};
}

//Time Axis Class to handle "data over time" graphs
function TimeAxis(canvas, y, orientation, scale, nticks) // an axis with ticks
{
	//Attributes------------------------------------------------------
	var self = this;
	
	self.Canvas = canvas;
	if (self.Canvas.ClassType === "Canvas")
		self.Canvas = canvas.getCanvas;
	self.Scale = scale;
	self.Orient = orientation;
	self.Y = y;
	self.Axis = null;
	self.NTicks = nticks;

	self.append = function () {
		if (self.Canvas !== undefined && self.Axis === null) {
			//check invalid arguments
			if (self.Y === undefined)
				self.Y = 0;

			if (self.Orient === undefined)
				self.Orient = "bottom";
			if (self.NTicks === undefined)
				self.NTicks = 10;
			if (self.Scale === undefined) {
				self.Scale = d3.scale.linear().domain([0, 100]).range([0, 320]);
			}

			//creates axis here
			self.Axis = d3.svg.axis().scale(self.Scale).orient(self.Orient); //Assign axis to just created scaled axis
			self.Axis.ticks(self.NTicks);

			//appending happens here
			self.Canvas.append("g")
			.classed("time-axis", true)
			.call(self.Axis)
			.attr("transform", function () {
				return ("translate(0, " + y + ")");
			});
		}
	};

	self.remove = function () {
		if (self.Axis !== null) {
			self.Axis.remove();
			self.Axis = null;
		}
	};

	self.update = function () {
		self.remove();
		self.append();
	};
}

function ComparisonGraphLine(canvas, match, type, x, y, scaleX, scaleY) {
	this.Canvas = canvas.getCanvas();
	this.Match = match;
	this.Type = type; //Gold, Kills or XP
	this.X = x;
	this.Y = y;
	this.ScaleX = scaleX;
	this.ScaleY = scaleY;
	this.Lines = [];
	this.LineGroup = null;
	this.HalfHeight = ((canvas.Height) / 2);

	//Iterates through teams and gets interest points over time
	this.build = function () {
		//build lines
		for (var i = 0; i < this.Match.EndTime - 1; i++) {

			var v = [this.ScaleX(i), this.ScaleY(this.Match.getDifference(i, this.Type)), this.ScaleX(i + 1), this.ScaleY(this.Match.getDifference(i + 1, this.Type))];
			this.Lines.push(v);
		}
	};

	this.append = function () {
		this.LineGroup = this.Canvas.append("g")
			.attr("class", "comparison-line-graph")
			.attr("transform", function () {
				return ("translate(" + this.X + ", " + this.Y + ")");
			});
		for (var i in this.Lines) {
			this.LineGroup.append("line")
			.attr("x1", this.Lines[i][0])
			.attr("y1", this.Lines[i][1])
			.attr("x2", this.Lines[i][2])
			.attr("y2", this.Lines[i][3])
			.attr("class", "line-graph-segment");
		}

		//appends time axis
		var axis = new TimeAxis(this.Canvas, this.HalfHeight, "bottom", this.ScaleX, 5);
		axis.append();

		//Text and some other stuff
		var mx = this.X;
		var my = this.Y + 16;
		var textTitle = this.Canvas.append("svg:text")
			.text("Line comparison graph: " + this.Type)
			.attr("class", "line-graph-title")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + this.X;
		my = this.Y + 64;
		var textTeam1 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team1.Name)
			.attr("class", "comparison-graph-text")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		my = canvas.Height - 64 + this.Y;
		var textTeam2 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team2.Name)
			.attr("class", "comparison-graph-text")
			.attr("transform", function () {
				return "translate(" + canvas.Width / 2 + ", " + my + ")";
			});
	};

	this.remove = function () {
		if (this.LineGroup !== null) {
			this.LineGroup.remove();
			this.LineGroup = null;
			this.Lines = [];
		}
	};
}

function ComparisonGraphBar(canvas, match, type, x, y, scaleX, scaleY) {

	this.Canvas = canvas.getCanvas();
	this.Match = match;
	this.Type = type;
	this.X = x;
	this.Y = y;
	this.ScaleX = scaleX;
	this.ScaleY = scaleY;
	this.Bars = [];
	this.BarsGroup = null;
	this.HalfHeight = (canvas.Height) / 2;

	//Iterates through teams and gets interest points over time
	this.build = function () {
		var barWidth = this.ScaleX((1 / this.Match.EndTime));
		for (var i = 0; i < this.Match.EndTime; i++) {
			//value = [x, y, width, height]
			var value = [this.ScaleX(i), this.HalfHeight, barWidth, this.Match.getDifference(i, this.Type) * this.HalfHeight / 10];
			this.Bars.push(value);
		}
	};

	this.append = function () {
		var mx = 0;
		var my = 0;

		//adds the group element
		this.BarsGroup = this.Canvas.append("g")
			.attr("class", "comparison-bar-graph")
			.attr("transform", function () {
				return ("translate(" + this.X + ", " + this.Y + ")");
			});

		//adds the bars
		for (var i in this.Bars) {
			var tbar = this.Bars[i];
			var fill = "black";
			if (tbar[3] < 0)
				fill = "red";
			else
				fill = "green";

			var bGraph = new Bar(this.BarsGroup, tbar[0], tbar[1], tbar[2], tbar[3], fill);
			bGraph.append();
		}

		//adds the informative text
		for (i in this.Bars) {
			var tbar = this.Bars[i];
			mx = tbar[0];
			if(tbar[3] > 0)
				my = this.HalfHeight - tbar[3] - 4;
			else
				my = this.HalfHeight - tbar[3] + 16;
			
			var mtrans = "translate(" + mx + ", " + my + ")";
			if(this.Match.getDifference(i, this.Type) !== 0){
			var infoT = this.BarsGroup.append("text").attr("class", "bar-info-text")
				.text(this.Match.getDifference(i, this.Type))
				.style("text-anchor", "middle")
				.attr("transform", mtrans);
				}
		}

		//appends time axis
		var axis = new TimeAxis(this.Canvas, this.HalfHeight, "bottom", this.ScaleX, 5);
		axis.append();

		//Text and some other stuff
		mx = this.X;
		my = this.Y + 16;
		var textTitle = this.Canvas.append("svg:text")
			.text("Bar comparison graph: " + this.Type)
			.attr("class", "bar-graph-title")
			.attr("transform", function () {

				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + this.X;
		my = 64 + this.Y;
		var textTeam1 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team2.Name)
			.attr("class", "comparison-graph-text")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		y = canvas.Height - 64 + this.Y;
		var textTeam2 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team1.Name)
			.attr("class", "comparison-graph-text")
			.attr("transform", function () {
				return "translate(" + canvas.Width / 2 + ", " + y + ")";
			});
	};

	this.remove = function () {
		this.Bars = [];
		this.BarsGroup.remove();
		this.BarsGroup = null;
	};
}

function TeamDetailGraph(canvas, team, x, y) { //display team name, list of players and their attributes
	this.Canvas = canvas;
	if (this.Canvas.ClassType === "Canvas")
		this.Canvas = canvas.getCanvas();
	this.Team = team;
	this.Group = null;
	this.X = x;
	this.Y = y;

	if ($.type(this.X) === "undefined")
		this.X = 0;
	if ($.type(this.Y) === "undefined")
		this.Y = 0;

	this.append = function () {
		this.Group = this.Canvas.append("g").attr("class", "team-detail-graph")
			.attr("transform", function () {
				return "translate(" + this.X + ", " + this.Y + ")";
			});

		this.Group.append("svg:text")
		.text("Team " + this.Team.Name)
		.attr("class", "team-graph-title")
		.attr("transform", function () {
			return "translate(" + 16 + ", " + 16 + ")";
		});

		function getTranslate(i) {
			var px = 32;
			if (i % 2 !== 0) {
				px += canvas.Width / 2;
			}
			var py = (Math.floor(i / 2) + 1) * 120;
			return "translate(" + px + ", " + py + ")";
		}
		function textTranslate(y) {
			return "translate(32, " + y + ")";
		}

		for (var i in this.Team.Players) {
			//creates new group to display player info
			var pinfo = this.Group.append("g").attr("class", "team-player-info")
				.attr("transform", getTranslate(i));
			var mplayer = this.Team.Players[i];

			pinfo.append("svg:text").attr("class", "team-player-info-name").text(mplayer.Name).attr("transform", textTranslate(4));
			pinfo.append("svg:text").attr("class", "team-player-info").text("Total Gold: " + mplayer.TotalGold).attr("transform", textTranslate(20));
			pinfo.append("svg:text").attr("class", "team-player-info").text("Total XP: " + mplayer.TotalXP).attr("transform", textTranslate(36));
			pinfo.append("svg:text").attr("class", "team-player-info").text("Level: " + mplayer.Level).attr("transform", textTranslate(52));
			pinfo.append("svg:text").attr("class", "team-player-info").text("Nation: " + mplayer.Nation).attr("transform", textTranslate(68));
		}

	};

	this.remove = function () {
		this.Group.remove();
		this.Group = null;
	};
}

function PlayerMatchGraph(canvas, match, player, scale, x, y) {
	this.Canvas = canvas;
	if (this.Canvas.ClassType === "Canvas")
		this.Canvas = canvas.getCanvas();
	this.Player = player;
	this.Scale = scale;
	this.X = x;
	this.Y = y;
	this.Group = null;
	this.StatusTokensGroup = null;

	if ($.type(this.X) === "undefined")
		this.X = 0;
	if ($.type(this.Y) === "undefined")
		this.Y = 0;

	this.append = function () {
		var gX = this.X;
		var gY = this.Y;

		this.Group = this.Canvas.append("g")
			.attr("class", "player-match-graph")
			.attr("transform", function () {
				return "translate(" + gX + ", " + gY + ")";
			});

		this.Group.append("svg:text").text("Player Match History")
		.attr("class", "player-match-title")
		.attr("transform", function () {
			return "translate(4, 32)";
		});

		this.Group.append("svg:text").text(this.Player.Name)
		.attr("class", "player-match-name")
		.attr("transform", function () {
			return "translate(32, 96)";
		});

		//Append status tokens
		this.StatusTokensGroup = this.Group.append("g").attr("class", "status-tokens-group");

		for (var i in this.Player.Status) {
			var status = this.Player.Status[i];
			var tx = this.Scale(status[0]);
			var ty = 0;
			switch (status[1]) {
			case "Frag":
				ty = 4;
				break;
			case "Gold":
				ty = 64;
				break;
			case "Death":
				ty = 124;
				break;
			}
			console.log("Status: " + status);
			var token = new StatusToken(this.StatusTokensGroup, status[1], tx, ty);
			token.append();
		}

		//put status token group on a feasible position
		this.StatusTokensGroup.attr("transform", function () {
			var stgX = 0;
			var stgY = gY + 180;

			return "translate(" + stgX + ", " + stgY + " )";
		});

		//put the axis
		var axis = new TimeAxis(this.Group, gY + 380, "bottom", this.Scale, 5);
		axis.append();
	};

	this.remove = function () {
		this.Group.remove();
		this.Group = null;
	};
}
