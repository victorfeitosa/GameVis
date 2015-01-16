//Import DATA stuff
$.getScript("gamevis/data.js", function () {
	if (DEBUG == true)
		alert("DATA script loaded and executed.");
});

//DONE: Every style-related option should be converted to CSS

//--IMPORTANT--
//TODO: Add more graph elements and structures

//TODO: Add graphics animations with ease and coloring
//TODO: Add implementation of tooltips and graph dots
//TODO: Add scale modularity to the graphs

//Graphics Package Globals--------------------------------------------------------
GRAPH_STYLE_SOURCE = 'CSS';

function isStyleSourceCSS() {
	return GRAPH_STYLE_SOURCE === 'CSS';
}

function isStyleSourceCode() {
	return GRAPH_STYLE_SOURCE === 'CODE';
}

function setGraphStyleSource(source) {
	if (source === 'CSS' || source === 'CODE')
		GRAPH_STYLE_SOURCE = source;
	else {
		console.error("ERROR: STYLE SOURCE IS NOT VALID!");
	}
}

function setGraphStyleSourceasCSS(b) {
	if (b) {
		setGraphStyleSource('CSS');
	}
}

function setGraphStyleSourceasCode(b) {
	if (b) {
		setGraphStyleSource('CODE');
	}
}


//*******************************************************************************************************************************************
//Drawgin-related Structures*****************************************************************************************************************
//*******************************************************************************************************************************************

//class to controll a bar graph
function Bar(canvas, x, y, width, height, fill, stroke, stroke_width, fill_op,
	stroke_op) {
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
	self.BarElement = null;

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
		if (self.Canvas != undefined && self.BarElement === null) {
			var mx = self.X - self.Width / 2; //defines the bar X center
			var my = 0;
			if (self.Height < 0) {
				my = self.Y;
				self.Height *= -1;
			} else
				my = self.Y - self.Height;

			self.BarElement = self.Canvas.append("rect").classed("bar-element",
					true) //set initial attributes
				.attr("transform", function () {
					return "translate(" + (mx) + ", " + (my) + ")";
				})
				.attr("width", self.Width)
				.attr("height", 0)
				.style("fill", d3.rgb(0, 0, 0));

			if (isStyleSourceCode()) {
				self.BarElement.style("stroke", self.Stroke)
					.style("stroke-width", self.StrokeWidth)
					.style("fill-opacity", self.FillOpacity)
					.style("stroke-opacity", self.StrokeOpacity);
			}

			//applying height transition
			//TODO: adjust this so the animation of the style coloring can be achieved through CSS as well
			self.BarElement
				.transition()
				.attr("height", self.Height)
				.style("fill", self.Fill)
				.duration(1000)
				.delay(100);
		}
	};

	self.remove = function () {
		if (self.BarElement !== null) {
			self.BarElement.remove();
			self.BarElement = null;
		}
	};

	self.reappend = function () { //instead of removing and re-appending, just make a transition
		self.remove();
		self.append();
	};

	self.getElement = function () {
		return self.BarElement;
	};
}

//TODO: implement this
function ToolTip(canvas, parent, x, y, tip, fill, stroke, stroke_width, fill_op,
	stroke_op) {
	//Attributes--------------------------------------------------------------------------

	var self = this;

	self.ClassType = "ToolTip";
	self.Canvas = canvas;
	self.Parent = parent;
	self.X = x;
	self.Y = y;
	self.Tip = tip;
	self.Fill = fill;
	self.Stroke = stroke;
	self.StrokeWidth = stroke_width;
	self.FillOpacity = fill_op;
	self.StrokeOpacity = stroke_op;
	self.ToolTipElement = null;

	//Methods-----------------------------------------------------------------------------
	self.append = function () {
		if (self.Tip === undefined) {
			self.Tip = "Sample ToolTip Text";
		}

		if (self.Fill === undefined) {
			self.Fill = "#FFF";
		}

		if (self.Stroke === undefined) {
			self.Stroke = "#FFF";
		}

		if (self.StrokeWidth === undefined) {
			self.StrokeWidth = 1;
		}

		if (self.FillOpacity === undefined) {
			self.FillOpacity = 1;
		}

		if (self.StrokeOpacity === undefined) {
			self.StrokeOpacity = 1;
		}

		//Appending
		if (self.Canvas !== undefined) {

			if (isStyleSourceCode()) {

			}
		}

	};

	self.remove = function () {
		if (self.ToolTipElement != null) {
			self.ToolTipElement.remove();
			self.ToolTipElement = null;
		}
	};

	self.reappend = function () {
		self.remove();
		self.append();
	};

	self.getElement = function () {
		return self.ToolTipElement;
	};
}


//TODO: implement this
//Defines a line dot token to mark something like a turning point, a tooltip, etc
function Dot(canvas, x, y, radius, fill, stroke, stroke_width, fill_op,
	stroke_op) {
	//Attributes--------------------------------------------------------------------------

	var self = this;

	self.ClassType = "Dot";

	self.Canvas = canvas;
	self.X = x;
	self.Y = y;
	self.Radius = radius;
	self.Fill = fill;
	self.Stroke = stroke;
	self.StrokeWidth = stroke_width;
	self.FillOpacity = fill_op;
	self.StrokeOpacity = stroke_op;
	self.DotElement = null;

	//Methods
	self.append() = function () {
		if (self.Tip === undefined) {
			self.Tip = "Sample ToolTip Text";
		}

		if (self.Radius === undefined) {
			self.Radius = 3;
		}

		if (self.Fill === undefined) {
			self.Fill = "#FFF";
		}

		if (self.Stroke === undefined) {
			self.Stroke = "#FFF";
		}

		if (self.StrokeWidth === undefined) {
			self.StrokeWidth = 1;
		}

		if (self.FillOpacity === undefined) {
			self.FillOpacity = 1;
		}

		if (self.StrokeOpacity === undefined) {
			self.StrokeOpacity = 1;
		}

		//Appending
		if (self.Canvas !== undefined) {
			self.DotElement = Canvas.append("circle")
				.attr("cx", self.X)
				.attr("cy", self.Y)
				.attr("r", self.Radius)
				.classed("dot", true);

			if (isStyleSourceCode()) {
				self.DotElement.attr("fill", self.Fill)
					.attr("stroke", self.Stroke)
					.attr("stroke-width", self.StrokeWidth)
					.attr("fill-opacity", self.FillOpacity)
					.attr("stroke-opacity", self.StrokeOpacity);
			}

		}
	};

	self.remove = function () {
		if (self.DotElement !== null) {
			self.DotElement.remove();
			self.DotElement = null;
		}
	};

	self.reappend = function () {
		self.remove();
		self.append();
	};

	self.getElement = function () {
		return self.DotElement;
	};
}

//Status Token class and color literals

//to change the colors of the statuses modify this code;
var TokenColors = [];
TokenColors.Death = [];
TokenColors.Frag = [];
TokenColors.Score = [];

TokenColors.Death.Fill = "#E61820";
TokenColors.Death.Stroke = "#9D4257";
TokenColors.Death.Text = "death";
TokenColors.Frag.Fill = "#4BB36C";
TokenColors.Frag.Stroke = "#36814D";
TokenColors.Frag.Text = "frag";
TokenColors.Score.Fill = "#EBCC28";
TokenColors.Score.Stroke = "#D69C0A";
TokenColors.Score.Text = "gold";

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
		self.TokenElement = null;
		self.TText = '';

		switch (self.Type) {
		case "death":
			self.Fill = TokenColors.Death.Fill;
			self.Stroke = TokenColors.Death.Stroke;
			self.TText = TokenColors.Death.Text;
			break;

		case "frag":
			self.Fill = TokenColors.Frag.Fill;
			self.Stroke = TokenColors.Frag.Stroke;
			self.TText = TokenColors.Frag.Text;
			break;

		case "gold":
			self.Fill = TokenColors.Score.Fill;
			self.Stroke = TokenColors.Score.Stroke;
			self.TText = TokenColors.Score.Text;
		}
		//TODO: update this class to handle CODE/CSS styles
		self.append = function () {
			if (self.Canvas != undefined && self.TokenElement === null) {
				//magic happens (appends ellipse and text)
				var x = self.X;
				var y = self.Y;
				var ry = self.RY;
				self.TokenElement = self.Canvas.append("g")
					.classed("status-token", true);

				var tokenkind = "status-token-" + type;
				self.TokenElement.append("ellipse")
					.attr("transform", function () {
						return "translate(" + x + ", " + y + ")";
					})
					.attr("rx", self.RX)
					.attr("ry", self.RY)
					.classed(tokenkind, true);


				self.TokenElement.classed("status-token", true);

				if (isStyleSourceCode()) {
					//Token Styling
					self.TokenElement.style("fill", self.Fill)
						.style("stroke", self.Stroke)
						.style("stroke-width", self.StrokeWidth)
						.style("fill-opacity", self.FillOpacity)
						.style("stroke-opacity", self.StrokeOpacity);
				}

				var text = self.TokenElement.append("text")
					.text(self.TText)
					.attr("transform", function () {
						return "translate(" + x + ", " + (y + ry / 5) + ")";
					})
					.classed("status-token-text", true);

				if (isStyleSourceCode()) {
					text.attr("font-family", "sans-serif")
						.attr("font-size", 18)
						.style("fill", "white")
						.style("text-anchor", "middle");
				}
			} else
			if (DEBUG == true)
				console.log("Error, token ellipse is null");
		};

		self.remove = function () {
			if (self.TokenElement !== null) {
				self.TokenElement.remove();
				self.TokenElement = null;
			}
		};

		self.reappend = function () {
			self.remove();
			self.append();
		};

		self.getElement = function () {
			return self.TokenElement;
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

		self.reappend = function () {
			self.remove();
			self.append();
		};
	}

function ComparisonGraphLine(canvas, match, type, x, y, scaleX, scaleY) {

	//Attributes-------------------------------------------------

	var self = this;

	self.Canvas = canvas.getCanvas();
	self.Match = match;
	self.Type = type; //Gold, Kills or XP
	self.X = x;
	self.Y = y;
	self.ScaleX = scaleX;
	self.ScaleY = scaleY;
	self.Lines = [];
	self.LineGroup = null;
	self.HalfHeight = ((canvas.Height) / 2);

	//Iterates through teams and gets interest points over time
	self.build = function () {
		//build lines
		for (var i = 0; i < self.Match.EndTime - 1; i++) {

			var v = [self.ScaleX(i), self.ScaleY(self.Match.getDifference(i, self
				.Type)), self.ScaleX(i + 1), self.ScaleY(self.Match.getDifference(
				i + 1, self.Type))];
			self.Lines.push(v);
		}
	};

	self.append = function () {
		self.LineGroup = self.Canvas.append("g")
			.classed("comparison-line-graph", true)
			.attr("transform", function () {
				return ("translate(" + self.X + ", " + self.Y + ")");
			});
		for (var i in self.Lines) {
			self.LineGroup.append("line")
				.attr("x1", self.Lines[i][0])
				.attr("y1", self.Lines[i][1])
				.attr("x2", self.Lines[i][2])
				.attr("y2", self.Lines[i][3])
				.classed("line-graph-segment", true);
		}

		//appends time axis
		var axis = new TimeAxis(self.Canvas, self.HalfHeight, "bottom", self.ScaleX,
			5);
		axis.append();

		//Text and some other stuff
		var mx = self.X;
		var my = self.Y + 16;
		var textTitle = self.Canvas.append("svg:text")
			.text("Line comparison graph: " + self.Type)
			.classed("line-graph-title", true)
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + self.X;
		my = self.Y + 64;
		var textTeam1 = self.Canvas.append("svg:text")
			.text("Team " + self.Match.Team1.Name)
			.classed("comparison-graph-text", true)
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		my = canvas.Height - 64 + self.Y;
		var textTeam2 = self.Canvas.append("svg:text")
			.text("Team " + self.Match.Team2.Name)
			.classed("comparison-graph-text", true)
			.attr("transform", function () {
				return "translate(" + canvas.Width / 2 + ", " + my + ")";
			});
	};

	self.remove = function () {
		if (self.LineGroup !== null) {
			self.LineGroup.remove();
			self.LineGroup = null;
			self.Lines = [];
		}
	};
}

function ComparisonGraphBar(canvas, match, type, x, y, scaleX, scaleY) {

	//Attributes-----------------------------------------------------------------

	var self = this;

	self.Canvas = canvas.getCanvas();
	self.Match = match;
	self.Type = type;
	self.X = x;
	self.Y = y;
	self.ScaleX = scaleX;
	self.ScaleY = scaleY;
	self.Bars = [];
	self.BarsGroup = null;
	self.HalfHeight = (canvas.Height) / 2;

	//Iterates through teams and gets interest points over time
	self.build = function () {
		var barWidth = self.ScaleX((1 / self.Match.EndTime));
		for (var i = 0; i < self.Match.EndTime; i++) {
			//value = [x, y, width, height]
			var value = [self.ScaleX(i), self.HalfHeight, barWidth, self.Match.getDifference(
				i, self.Type) * self.HalfHeight / 10];
			self.Bars.push(value);
		}
	};

	self.append = function () {
		var mx = 0;
		var my = 0;

		//adds the group element
		self.BarsGroup = self.Canvas.append("g")
			.classed("comparison-bar-graph", true)
			.attr("transform", function () {
				return ("translate(" + self.X + ", " + self.Y + ")");
			});

		//adds the bars
		for (var i in self.Bars) {
			var tbar = self.Bars[i];
			var fill = "black";
			if (tbar[3] < 0)
				fill = "red";
			else
				fill = "green";

			var bGraph = new Bar(self.BarsGroup, tbar[0], tbar[1], tbar[2], tbar[
				3], fill);
			bGraph.append();
		}

		//adds the informative text
		for (i in self.Bars) {
			var tbar = self.Bars[i];
			mx = tbar[0];
			if (tbar[3] > 0)
				my = self.HalfHeight - tbar[3] - 4;
			else
				my = self.HalfHeight - tbar[3] + 16;

			var mtrans = "translate(" + mx + ", " + my + ")";
			if (self.Match.getDifference(i, self.Type) !== 0) {
				var infoT = self.BarsGroup.append("text")
					.classed("bar-info-text", true)
					.text(self.Match.getDifference(i, self.Type))
					.style("text-anchor", "middle")
					.attr("transform", mtrans);
			}
		}

		//appends time axis
		var axis = new TimeAxis(self.Canvas, self.HalfHeight, "bottom", self.ScaleX,
			5);
		axis.append();

		//Text and some other stuff
		mx = self.X;
		my = self.Y + 16;
		var textTitle = self.Canvas.append("svg:text")
			.text("Bar comparison graph: " + self.Type)
			.classed("bar-graph-title", true)
			.attr("transform", function () {

				return "translate(" + mx + ", " + my + ")";
			});

		mx = canvas.Width / 2 + self.X;
		my = 64 + self.Y;
		var textTeam1 = self.Canvas.append("svg:text")
			.text("Team " + self.Match.Team2.Name)
			.classed("comparison-graph-text", true)
			.attr("transform", function () {
				return "translate(" + mx + ", " + my + ")";
			});

		y = canvas.Height - 64 + self.Y;
		var textTeam2 = self.Canvas.append("svg:text")
			.text("Team " + self.Match.Team1.Name)
			.classed("comparison-graph-text", true)
			.attr("transform", function () {
				return "translate(" + canvas.Width / 2 + ", " + y + ")";
			});
	};

	self.remove = function () {
		self.Bars = [];
		self.BarsGroup.remove();
		self.BarsGroup = null;
	};
}

function TeamDetailGraph(canvas, team, x, y) { //display team name, list of players and their attributes

	//Attributes---------------------------------------------------------
	var self = this;

	self.Canvas = canvas;
	if (self.Canvas.ClassType === "Canvas")
		self.Canvas = canvas.getCanvas();
	self.Team = team;
	self.Group = null;
	self.X = x;
	self.Y = y;

	if (self.X === undefined)
		self.X = 0;
	if (self.Y === undefined)
		self.Y = 0;

	self.append = function () {
		self.Group = self.Canvas.append("g").classed("team-detail-graph", true)
			.attr("transform", function () {
				return "translate(" + self.X + ", " + self.Y + ")";
			});

		self.Group.append("svg:text")
			.text("Team " + self.Team.Name)
			.classed("team-graph-title", true)
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

		for (var i in self.Team.Players) {
			//creates new group to display player info
			var pinfo = self.Group.append("g").classed("team-player-info", true)
				.attr("transform", getTranslate(i));
			var mplayer = self.Team.Players[i];

			pinfo.append("svg:text").classed("team-player-info-name", true).text(
				mplayer.Name).attr("transform", textTranslate(4));
			pinfo.append("svg:text").classed("team-player-info", true).text(
				"Total Gold: " + mplayer.TotalGold).attr("transform",
				textTranslate(20));
			pinfo.append("svg:text").classed("team-player-info", true).text(
				"Total XP: " + mplayer.TotalXP).attr("transform", textTranslate(
				36));
			pinfo.append("svg:text").classed("team-player-info", true).text(
				"Level: " + mplayer.Level).attr("transform", textTranslate(52));
			pinfo.append("svg:text").classed("team-player-info", true).text(
				"Nation: " + mplayer.Nation).attr("transform", textTranslate(68));
		}

	};

	self.remove = function () {
		self.Group.remove();
		self.Group = null;
	};
}

function PlayerMatchGraph(canvas, match, player, scale, x, y) {
	//Attributes---------------------------------------------------------------
	var self = this;

	self.Canvas = canvas;
	if (self.Canvas.ClassType === "Canvas")
		self.Canvas = canvas.getCanvas();
	self.Player = player;
	self.Scale = scale;
	self.X = x;
	self.Y = y;
	self.Group = null;
	self.StatusTokensGroup = null;

	if ($.type(self.X) === "undefined")
		self.X = 0;
	if ($.type(self.Y) === "undefined")
		self.Y = 0;

	self.append = function () {
		var gX = self.X;
		var gY = self.Y;

		self.Group = self.Canvas.append("g")
			.classed("player-match-graph", true)
			.attr("transform", function () {
				return "translate(" + gX + ", " + gY + ")";
			});

		self.Group.append("svg:text").text("Player Match History")
			.classed("player-match-title", true)
			.attr("transform", function () {
				return "translate(4, 32)";
			});

		self.Group.append("svg:text").text(self.Player.Name)
			.classed("player-match-name", true)
			.attr("transform", function () {
				return "translate(32, 96)";
			});

		//Append status tokens
		self.StatusTokensGroup = self.Group.append("g").classed(
			"status-tokens-group", true);

		for (var i in self.Player.Status) {
			var status = self.Player.Status[i];
			var tx = self.Scale(status[0]);
			var ty = 0;
			switch (status[1]) {
				//TODO: adjust this to adapt to the canvas size
			case "frag":
				ty = 4;
				break;
			case "gold":
				ty = 64;
				break;
			case "death":
				ty = 124;
				break;
			}
			if (DEBUG == true)
				console.log("Status: " + status);
			var token = new StatusToken(self.StatusTokensGroup, status[1], tx, ty);
			token.append();
		}

		//put status token group on a feasible position
		self.StatusTokensGroup.attr("transform", function () {
			var stgX = 0;
			var stgY = gY + 180;

			return "translate(" + stgX + ", " + stgY + " )";
		});

		//put the axis
		var axis = new TimeAxis(self.Group, gY + 380, "bottom", self.Scale, 5);
		axis.append();
	};

	self.remove = function () {
		self.Group.remove();
		self.Group = null;
	};
}
