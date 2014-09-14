
//Game stuctures*****************************************************************************************************************************

function Canvas(width, height, bgcolor, label) {
	this.Width = width;
	this.Height = height;
	this.BGColor = bgcolor;
	this.Label = label;
	this.SVGCanvas = null;
	this.ClassType = "Canvas";

	this.append = function () {
		//check missing stuff
		if ($.type(this.Width) === "undefined")
			this.Width = 640;
		if ($.type(this.Height) === "undefined")
			this.Height = 480;
		if ($.type(this.BGColor) === "undefined")
			this.BGColor = "0xAAAAAA";
		if ($.type(this.Label) === "undefined")
			this.Label = "Game Graph:";

		//actual appending
		if (this.SVGCanvas === null) {
			this.SVGCanvas = d3.select("body").append("svg")
				.attr("width", this.Width)
				.attr("height", this.Height)
				.style("padding", 20)
				.style("background-color", this.BGColor);
		}
	};

	this.remove = function () {
		if (SVGCanvas !== null)
			this.SVGCanvas.remove();
	};

	this.getCanvas = function () {
		return this.SVGCanvas;
	};
}

//Player Class-------------------------------------------------------------------------------------------------------------------------------
function Player(name, rank, team, nation, tgold, txp, level) {
	//Attributes------------------------------------------------------------

	//Global attributes
	this.Name = name;
	this.Rank = rank;
	this.Team = team;
	this.Nation = nation;
	this.TotalGold = tgold;
	this.TotalXP = txp;
	this.Level = level;
	this.ClassType = "Player";

	//Match attributes
	this.CurrentGold = 0;
	this.CurrentXP = 0;
	this.CurrentKills = 0;
	this.CurrentDeaths = 0;
	this.Status = []; //frag, death, gold

	//Methods------------------------------------------------------------------
	this.print = function () {
		console.log("Name: " + this.Name);
		console.log("Rank: " + this.Rank);
		console.log("Team: " + this.Team);
		console.log("Nation: " + this.Nation);
		console.log("Total Gold: " + this.TotalGold);
		console.log("Total XP: " + this.TotalXP);
	};

	this.addDeath = function (time) {
		this.CurrentDeaths++;
		if (this.CurrentGold >= 100)
			this.CurrentGold -= 100;
		if (this.TotalGold >= 100)
			this.TotalGold -= 100;
		this.Status.push([time, "Death"]);
	};

	this.addGold = function (time, amount) {
		this.CurrentGold += amount;
		this.TotalGold += amount;
		this.Status.push([time, "Gold"]);
	};

	this.addXP = function (amount) {
		this.CurrentXP += amount;
		this.TotalXP += amount;
	};

	this.addKill = function (time) { //adds a kill, xp and gold and informs who was killed
		this.CurrentKills++;
		this.addXP(200);

		this.CurrentGold += 250;
		this.TotalGold += 250;

		this.Status.push([time, "Frag"]);
	};
}

//Team Class---------------------------------------------------------------------------------------------------------------------------------
function Team(name, rank, nation) {
	//Attributes-----------------------------------------------------------------
	this.ClassType = "Team";
	//Team common attributes
	this.Name = name;
	this.Rank = rank;
	this.Nation = nation;

	//Team attributes calculated on-demand
	this.Players = [];
	this.Gold = 0;
	this.NumKills = 0;
	this.AverageLevel = 0;

	//Methods----------------------------------------------------------------------

	//Calculates the stuff
	this.getAverageLevel = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].Level;
		}

		n /= Players.length;

		return n;
	};

	this.getKills = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentKills;
		}

		this.NumKills = n;

		return n;
	};

	this.getDeaths = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentDeaths;
		}

		return n;
	};

	this.getXP = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentXP;
		}

		return n;
	};

	this.getGold = function () {
		var n = 0;
		for (var i in this.Players) {
			n += this.Players[i].CurrentGold;
		}

		this.Gold = n;

		return n;
	};

	//add/remove  Players
	this.addPlayer = function (player) {
		this.Players.push(player);
	};

	this.removePlayer = function (ppos) {
		this.Players.splice(ppos, 1);
	};

	this.print = function () {
		console.log("Team " + this.Name + " profile:");
		console.log("-Players: ");
		for (var i in this.Players) {
			console.log("Player[" + i + 1 + "]: " + this.Players[i].Name);
		}
		console.log("-XP: " + this.getXP());
		console.log("-Gold: " + this.getGold());
	};
}

//Match Class--------------------------------------------------------------------------------------------------------------------------------
function Match(team1, team2, endtime) {
	//Attributes
	this.ClassType = "Match";

	this.Team1 = team1;
	this.Team2 = team2;

	this.CurrentTime = 0;
	this.EndTime = endtime;

	this.GoldDifference = [];
	this.XPDifference = [];
	this.KillDifference = [];

	//Methods

	//init match, must be used before stuff gets computed
	this.init = function () {
		if (this.EndTime > 0) {
			//init difference arrays and player time array
			for (var i = 0; i < this.EndTime; i++) {
				this.GoldDifference.push(0);
				this.KillDifference.push(0);
				this.XPDifference.push(0);
			}
		}
	};

	//update stuff from teams and players
	this.addPlayerKill = function (killerTeam, victimTeam, killer, victim) {

		if ((killer.ClassType === "Player" && victim.ClassType === "Player") && (killerTeam.ClassType === "Team" && victimTeam.ClassType === "Team") && this.CurrentTime < this.EndTime) {
			killer.addKill(this.CurrentTime);
			victim.addDeath(this.CurrentTime);
			killerTeam.getKills();
			victimTeam.getDeaths();

		}
	};

	this.addPlayerGold = function (team, player, amount) {
		if (this.CurrentTime < this.EndTime) {
			player.addGold(this.CurrentTime, amount);
			team.getGold();
		}
	};

	this.addPlayerXP = function (team, player, amount) {
		if (this.CurrentTime < this.EndTime) {
			player.addXP(amount);
			team.getXP();
		}
	};

	this.getMatchTime = function (time) {
		return this.CurrentTime;
	};

	//return differences according to time
	this.calculateDifference = function (time, what) {
		var ret = 0;
		switch (what) {
		case "Gold":
			ret = this.Team2.getGold() - this.Team1.getGold();
			break;
		case "XP":
			ret = this.Team2.getXP() - this.Team1.getXP();
			break;
		case "Kills":
			ret = this.Team2.getKills() - this.Team1.getKills();
			break;
		}
		return ret;
	};

	this.getDifference = function (time, what) {
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

	//updates the match status adding kills, gold, etc
	this.update = function () {
		var time = this.CurrentTime;
		if (time <= this.EndTime) {
			this.GoldDifference.push(this.calculateDifference(time, "Gold"));
			this.XPDifference.push(this.calculateDifference(time, "XP"));
			this.KillDifference.push(this.calculateDifference(time, "Kills"));

			this.CurrentTime++;
		}
	};
}

//Drawgin-related Structures*****************************************************************************************************************
//class to controll a bar graph
function Bar(canvas, x, y, width, height, fill, stroke, stroke_width, fill_op, stroke_op) {
	//attributes
	this.ClassType = "Bar";

	//checks if it is a group or a canvas
	this.Canvas = canvas;
	if (this.Canvas.ClassType === "Canvas")
		this.Canvas = canvas.getCanvas();
	//--------------------------------------
	this.X = x;
	this.Y = y;
	this.Width = width;
	this.Height = height;
	this.Fill = fill;
	this.Stroke = stroke;
	this.StrokeWidth = stroke_width;
	this.FillOpacity = fill_op;
	this.StrokeOpacity = stroke_op;
	this.BarChart = null;

	this.append = function () {
		//Desfine default values-------------------------------------------------------------------------
		if ($.type(fill) === "undefined") //if color is undefined, assign black
		{
			fill = d3.rgb(0, 0, 0);
		}

		if ($.type(stroke) === "undefined") //if color is undefined, assign black
		{
			stroke = d3.rgb(0, 0, 0);
		}

		if ($.type(stroke_width) === "undefined") //if width is undefined, assign 0
		{
			stroke_width = 0;
		}

		if ($.type(fill_op) === "undefined") //if opacity is undefined, assign 1
		{
			fill_op = 1;
		}

		if ($.type(stroke_op) === "undefined") //if opacity is undefined, assign 1
		{
			stroke_op = 1;
		}

		//actual appending--------------------------------------------------------
		//appends in a canvas or group
		if ($.type(this.Canvas) != "undefined" && $.type(this.BarChart) === "null") {
			var mx = this.X - this.Width / 2; //var organization
			var my = 0;
			if (this.Height <= 0) {
				my = this.Y;
				this.Height *= -1;
			} else
				my = this.Y - this.Height;

			this.BarChart = this.Canvas.append("rect").attr("class", "bar-element")
				.attr("transform", function () {
					return "translate(" + (mx) + ", " + (my) + ")";
				})
				.attr("width", this.Width)
				.attr("height", this.Height)
				.style("fill", this.Fill)
				.style("stroke", this.Stroke)
				.style("stroke-width", this.StrokeWidth)
				.style("fill-opacity", this.FillOpacity)
				.style("stroke-opacity", this.StrokeOpacity);
		}
	};

	this.remove = function () {
		if (this.BarChart !== null) {
			this.BarChart.remove();
			this.BarChart = null;
		}
	};

	this.update = function () {
		this.remove();
		this.append();
	};
}

function StatusToken(canvas, type, x, y) //an ellipse rect with text and color
{
	this.ClassType = "StatusToken";
	this.Canvas = canvas;
	if (this.Canvas.ClassType === "Canvas")
		this.Canvas = canvas.getCanvas();
	this.Type = type;
	this.X = x;
	this.Y = y;
	this.RX = 35;
	this.RY = 30;
	this.Fill = d3.rgb(0, 0, 0);
	this.Stroke = d3.rgb(0, 0, 0);
	this.StrokeWidth = 5.0;
	this.FillOpacity = 0.85;
	this.StrokeOpacity = 0.9;
	this.Token = null;

	switch (this.Type) {
	case "Death":
		this.Fill = "#E61820";
		this.Stroke = "#9D4257";
		this.Text = "Died";
		break;

	case "Frag":
		this.Fill = "#4BB36C";
		this.Stroke = "#36814D";
		this.Text = "Frag";
		break;

	case "Gold":
		this.Fill = "#EBCC28";
		this.Stroke = "#D69C0A";
		this.Text = "Gold";
		break;
	}

	this.append = function () {
		if ($.type(this.Canvas) != "undefined" && $.type(this.Token) === "null") {
			//magic happens (appends ellipse and text)
			var x = this.X;
			var y = this.Y;
			var ry = this.RY;
			this.Token = this.Canvas.append("g").attr("class", "status-token");

			this.Token.append("ellipse")
			.attr("transform", function () {
				return "translate(" + x + ", " + y + ")";
			})
			.attr("rx", this.RX)
			.attr("ry", this.RY)
			.style("fill", this.Fill)
			.style("stroke", this.Stroke)
			.style("stroke-width", this.StrokeWidth)
			.style("fill-opacity", this.FillOpacity)
			.style("stroke-opacity", this.StrokeOpacity);

			var text = this.Token.append("text")
				.text(this.Text)
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

	this.remove = function () {
		if (this.Token !== null) {
			this.Token.remove();
			this.Token = null;
		}
	};

	this.update = function () {
		this.remove();
		this.append();
	};
}

//Time Axis Class to handle "data over time" graphs
function TimeAxis(canvas, y, orientation, scale, nticks) // an axis with ticks
{
	this.Canvas = canvas;
	if (this.Canvas.ClassType === "Canvas")
		this.Canvas = canvas.getCanvas;
	this.Scale = scale;
	this.Orient = orientation;
	this.Y = y;
	this.Axis = null;
	this.NTicks = nticks;

	this.append = function () {
		if ($.type(this.Canvas) !== "undefined" && $.type(this.Axis) === "null") {
			//check invalid arguments
			if ($.type(this.Y) === "undefined")
				this.Y = 0;

			if ($.type(this.Orient) === "undefined")
				this.Orient = "bottom";
			if ($.type(this.NTicks) === "undefined")
				this.NTicks = 10;
			if ($.type(this.Scale) === "undefined") {
				this.Scale = d3.scale.linear().domain([0, 100]).range([0, 320]);
			}

			//creates axis here
			this.Axis = d3.svg.axis().scale(this.Scale).orient(this.Orient); //Assign axis to just created scaled axis
			this.Axis.ticks(this.NTicks);

			//appending happens here
			this.Canvas.append("g")
			.attr("class", "time-axis")
			.call(this.Axis)
			.attr("transform", function () {
				return ("translate(0, " + y + ")");
			});
		}
	};

	this.remove = function () {
		if (this.Axis !== null) {
			this.Axis.remove();
			this.Axis = null;
		}
	};

	this.update = function () {
		this.remove();
		this.append();
	};
}

function ComparsionGraphLine(canvas, match, type, x, y, scaleX, scaleY) {
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
			.attr("class", "comparsion-line-graph")
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
			.text("Line Comparsion graph: " + this.Type)
			.attr("class", "line-graph-title")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + this.X;
		my = this.Y + 64;
		var textTeam1 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team1.Name)
			.attr("class", "comparsion-graph-text")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		my = canvas.Height - 64 + this.Y;
		var textTeam2 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team2.Name)
			.attr("class", "comparsion-graph-text")
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

function ComparsionGraphBar(canvas, match, type, x, y, scaleX, scaleY) {

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
			.attr("class", "comparsion-bar-graph")
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
			.text("Bar Comparsion graph: " + this.Type)
			.attr("class", "bar-graph-title")
			.attr("transform", function () {

				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + this.X;
		my = 64 + this.Y;
		var textTeam1 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team2.Name)
			.attr("class", "comparsion-graph-text")
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		y = canvas.Height - 64 + this.Y;
		var textTeam2 = this.Canvas.append("svg:text")
			.text("Team " + this.Match.Team1.Name)
			.attr("class", "comparsion-graph-text")
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
