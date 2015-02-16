//Graphics module
//Responsible for graphic structures and drawing charts
define(function (require) {

  data = require('gamevis/data');


  //*******************************************************************************************************************************************
  //Drawgin-related Structures*****************************************************************************************************************
  //*******************************************************************************************************************************************
  //class to controll a bar graph
  function Bar(canvas, x, y, width, height, fill, stroke, stroke_width,
    fill_op,
    stroke_op) {
    //attributes

    var self = this;

    self.ClassType = 'Bar';

    //checks if it is a group or a canvas
    self.Canvas = canvas;

    if (self.Canvas.ClassType === 'Canvas')
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
  }

  //Methods-----

  Bar.prototype.append = function () {
    var self = this;

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
    if (self.Canvas !== undefined && self.BarElement === null) {
      var mx = self.X - self.Width / 2; //defines the bar X center
      var my = 0;
      if (self.Height < 0) {
        my = self.Y;
        self.Height *= -1;
      } else
        my = self.Y - self.Height;

      self.BarElement = self.Canvas.append('rect').classed('bar-element',
          true) //set initial attributes
        .attr('transform', function () {
          return 'translate(' + (mx) + ', ' + (my) + ')';
        })
        .attr('width', self.Width)
        .attr('height', 0)
        .style('fill', d3.rgb(0, 0, 0));

      if (data.isStyleSourceCode()) {
        self.BarElement.style('stroke', self.Stroke)
          .style('stroke-width', self.StrokeWidth)
          .style('fill-opacity', self.FillOpacity)
          .style('stroke-opacity', self.StrokeOpacity);
      }

      //applying height transition
      //TODO: adjust this so the animation of the style coloring can be achieved through CSS as well
      self.BarElement
        .transition()
        .attr('height', self.Height)
        .style('fill', self.Fill)
        .duration(1000)
        .delay(100);
    }
  };

  Bar.prototype.remove = function () {
    if (this.BarElement !== null) {
      this.BarElement.remove();
      this.BarElement = null;
    }
  };

  Bar.prototype.reappend = function () { //instead of removing and re-appending, just make a transition
    this.remove();
    this.append();
  };

  Bar.prototype.getElement = function () {
    return this.BarElement;
  };

  //TODO: implement this
  function ToolTip(canvas, parent, x, y, tip, fill, stroke, stroke_width,
    fill_op,
    stroke_op) {
    //Attributes------------------------------------------------------------

    var self = this;

    self.ClassType = 'ToolTip';
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
  }

  //Methods---------------------------------------------------------------
  ToolTip.prototype.append = function () {
    if (this.Tip === undefined) {
      this.Tip = 'Sample ToolTip Text';
    }

    if (this.Fill === undefined) {
      this.Fill = '#FFF';
    }

    if (this.Stroke === undefined) {
      this.Stroke = '#FFF';
    }

    if (this.StrokeWidth === undefined) {
      this.StrokeWidth = 1;
    }

    if (this.FillOpacity === undefined) {
      this.FillOpacity = 1;
    }

    if (this.StrokeOpacity === undefined) {
      this.StrokeOpacity = 1;
    }

    //Appending
    if (this.Canvas !== undefined) {

      if (this.isStyleSourceCode()) {

      }
    }

  };

  ToolTip.prototype.remove = function () {
    if (this.ToolTipElement !== null) {
      this.ToolTipElement.remove();
      this.ToolTipElement = null;
    }
  };

  ToolTip.prototype.reappend = function () {
    this.remove();
    this.append();
  };

  ToolTip.prototype.getElement = function () {
    return self.ToolTipElement;
  };


  //TODO: implement this
  //Defines a line dot token to mark something like a turning point, a tooltip, etc
  function Dot(canvas, x, y, radius, fill, stroke, stroke_width, fill_op,
    stroke_op) {
    //Attributes--------------------------------------------------------------------------

    var self = this;

    self.ClassType = 'Dot';

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
  }

  //Methods------
  Dot.prototype.append = function () {
    if (this.Tip === undefined) {
      this.Tip = 'Sample ToolTip Text';
    }

    if (this.Radius === undefined) {
      this.Radius = 3;
    }

    if (this.Fill === undefined) {
      this.Fill = '#FFF';
    }

    if (this.Stroke === undefined) {
      this.Stroke = '#FFF';
    }

    if (this.StrokeWidth === undefined) {
      this.StrokeWidth = 1;
    }

    if (this.FillOpacity === undefined) {
      this.FillOpacity = 1;
    }

    if (this.StrokeOpacity === undefined) {
      this.StrokeOpacity = 1;
    }

    //Appending
    if (this.Canvas !== undefined) {
      this.DotElement = Canvas.append('circle')
        .attr('cx', this.X)
        .attr('cy', this.Y)
        .attr('r', this.Radius)
        .classed('dot', true);

      if (data.isStyleSourceCode()) {
        this.DotElement.attr('fill', this.Fill)
          .attr('stroke', this.Stroke)
          .attr('stroke-width', this.StrokeWidth)
          .attr('fill-opacity', this.FillOpacity)
          .attr('stroke-opacity', this.StrokeOpacity);
      }

    }
  };

  Dot.prototype.remove = function () {
    if (this.DotElement !== null) {
      this.DotElement.remove();
      this.DotElement = null;
    }
  };

  Dot.prototype.reappend = function () {
    this.remove();
    this.append();
  };

  Dot.prototype.getElement = function () {
    return this.DotElement;
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

  function StatusToken(canvas, type, x, y) //an ellipse rect with text and color
    {
      //Attributes----------------------------------------------------------------
      var self = this;

      self.ClassType = 'StatusToken';
      self.Canvas = canvas;
      if (self.Canvas.ClassType === 'Canvas')
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
      case 'death':
        self.Fill = TokenColors.Death.Fill;
        self.Stroke = TokenColors.Death.Stroke;
        self.TText = TokenColors.Death.Text;
        break;

      case 'frag':
        self.Fill = TokenColors.Frag.Fill;
        self.Stroke = TokenColors.Frag.Stroke;
        self.TText = TokenColors.Frag.Text;
        break;

      case 'gold':
        self.Fill = TokenColors.Score.Fill;
        self.Stroke = TokenColors.Score.Stroke;
        self.TText = TokenColors.Score.Text;
      }
    }

  //Methods----------
  //TODO: update this class to handle CODE/CSS styles
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
      self.TokenElement.append('ellipse')
        .attr('transform', function () {
          return 'translate(' + x + ', ' + y + ')';
        })
        .attr('rx', self.RX)
        .attr('ry', self.RY)
        .classed(tokenkind, true);


      self.TokenElement.classed('status-token', true);

      if (data.isStyleSourceCode()) {
        //Token Styling
        self.TokenElement.style('fill', self.Fill)
          .style('stroke', self.Stroke)
          .style('stroke-width', self.StrokeWidth)
          .style('fill-opacity', self.FillOpacity)
          .style('stroke-opacity', self.StrokeOpacity);
      }

      var text = self.TokenElement.append('text')
        .text(self.TText)
        .attr('transform', function () {
          return 'translate(' + x + ', ' + (y + ry / 5) + ')';
        })
        .classed('status-token-text', true);

      if (data.isStyleSourceCode()) {
        text.attr('font-family', 'sans-serif')
          .attr('font-size', 18)
          .style('fill', 'white')
          .style('text-anchor', 'middle');
      }
    } else
    if (data.DEBUG === true)
      console.log('Error, token ellipse is null');
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

  StatusToken.prototype.getElement = function () {
    return this.TokenElement;
  };

  //Time Axis Class to handle "data over time" graphs
  function TimeAxis(canvas, y, orientation, scale, nticks) // an axis with ticks
    {
      //Attributes------------------------------------------------------
      this.Canvas = canvas;
      if (this.Canvas.ClassType === 'Canvas')
        this.Canvas = canvas.getCanvas;
      this.Scale = scale;
      this.Orient = orientation;
      this.Y = y;
      this.Axis = null;
      this.NTicks = nticks;

    }

  //Methods----------------
  TimeAxis.prototype.append = function () {
    var self = this;
    if (self.Canvas !== undefined && self.Axis === null) {
      //check invalid arguments
      if (self.Y === undefined)
        self.Y = 0;

      if (self.Orient === undefined)
        self.Orient = 'bottom';
      if (self.NTicks === undefined)
        self.NTicks = 10;
      if (self.Scale === undefined) {
        self.Scale = d3.scale.linear().domain([0, 100]).range([0, 320]);
      }

      //creates axis here
      self.Axis = d3.svg.axis().scale(self.Scale).orient(self.Orient); //Assign axis to just created scaled axis
      self.Axis.ticks(self.NTicks);

      //appending happens here
      self.Canvas.append('g')
        .classed('time-axis', true)
        .call(self.Axis)
        .attr('transform', function () {
          return ('translate(0, ' + self.Y + ')');
        });
    }
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

  function ComparisonGraphLine(canvas, match, type, x, y, scaleX, scaleY) {

    //Attributes-------------------------------------------------

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

    self.LineGroup = self.Canvas.append('g')
      .classed('comparison-line-graph', true)
      .attr('transform', function () {
        return ('translate(' + self.X + ', ' + self.Y + ')');
      });
    for (var i in self.Lines) {
      self.LineGroup.append('line')
        .attr('x1', self.Lines[i][0])
        .attr('y1', self.Lines[i][1])
        .attr('x2', self.Lines[i][2])
        .attr('y2', self.Lines[i][3])
        .classed('line-graph-segment', true);
    }

    //appends time axis
    var axis = new TimeAxis(self.Canvas, self.HalfHeight, 'bottom',
      self.ScaleX,
      5);
    axis.append();

    //Text and some other stuff
    var mx = self.X;
    var my = self.Y + 16;
    var textTitle = self.Canvas.append('svg:text')
      .text('Line comparison graph: ' + self.Type)
      .classed('line-graph-title', true)
      .attr('transform', function () {
        return 'translate(' + mx + ', ' + my + ')';
      });

    mx = canvas.Width / 2 + self.X;
    my = self.Y + 64;
    var textTeam1 = self.Canvas.append('svg:text')
      .text('Team ' + self.Match.Team[0].Name)
      .classed('comparison-graph-text', true)
      .attr('transform', function () {
        return 'translate(' + mx + ', ' + my + ')';
      });

    my = canvas.Height - 64 + self.Y;
    var textTeam2 = self.Canvas.append('svg:text')
      .text('Team ' + self.Match.Team[1].Name)
      .classed('comparison-graph-text', true)
      .attr('transform', function () {
        return 'translate(' + canvas.Width / 2 + ', ' + my + ')';
      });
  };

  ComparisonGraphLine.prototype.remove = function () {
    if (this.LineGroup !== null) {
      this.LineGroup.remove();
      this.LineGroup = null;
      this.Lines = [];
    }
  };

  function ComparisonGraphBar(canvas, match, type, x, y, scaleX, scaleY) {

    //Attributes-----------------------------------------------------------------
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

  }

  //Methods-------------
  //Iterates through teams and gets interest points over time
  ComparisonGraphBar.prototype.build = function () {
    var barWidth = this.ScaleX((1 / this.Match.EndTime));
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
    self.BarsGroup = self.Canvas.append('g')
      .classed('comparison-bar-graph', true)
      .attr('transform', function () {
        return ('translate(' + self.X + ', ' + self.Y + ')');
      });

    //adds the bars
    for (var i in self.Bars) {
      var tbar = self.Bars[i];
      var fill = 'black';
      if (tbar[3] < 0)
        fill = 'red';
      else
        fill = 'green';

      var bGraph = new Bar(self.BarsGroup, tbar[0], tbar[1], tbar[2],
        tbar[
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

      var mtrans = 'translate(' + mx + ', ' + my + ')';
      if (self.Match.getDifference(i, self.Type) !== 0) {
        var infoT = self.BarsGroup.append('text')
          .classed('bar-info-text', true)
          .text(self.Match.getDifference(i, self.Type))
          .style('text-anchor', 'middle')
          .attr('transform', mtrans);
      }
    }

    //appends time axis
    var axis = new TimeAxis(self.Canvas, self.HalfHeight, 'bottom',
      self.ScaleX,
      5);
    axis.append();

    //Text and some other stuff
    mx = self.X;
    my = self.Y + 16;
    var textTitle = self.Canvas.append('svg:text')
      .text('Bar comparison graph: ' + self.Type)
      .classed('bar-graph-title', true)
      .attr('transform', function () {

        return 'translate(' + mx + ', ' + my + ')';
      });

    mx = canvas.Width / 2 + self.X;
    my = 64 + self.Y;
    var textTeam1 = self.Canvas.append('svg:text')
      .text('Team ' + self.Match.Team[0].Name)
      .classed('comparison-graph-text', true)
      .attr('transform', function () {
        return 'translate(' + mx + ', ' + my + ')';
      });

    y = canvas.Height - 64 + self.Y;
    var textTeam2 = self.Canvas.append('svg:text')
      .text('Team ' + self.Match.Team[1].Name)
      .classed('comparison-graph-text', true)
      .attr('transform', function () {
        return 'translate(' + canvas.Width / 2 + ', ' + y + ')';
      });
  };

  ComparisonGraphBar.prototype.remove = function () {
    this.Bars = [];
    this.BarsGroup.remove();
    this.BarsGroup = null;
  };

  function TeamDetailGraph(canvas, team, x, y) { //display team name, list of players and their attributes

    //Attributes---------------------------------------------------------

    this.Canvas = canvas;
    if (this.Canvas.ClassType === 'Canvas')
      this.Canvas = canvas.getCanvas();
    this.Team = team;
    this.Group = null;
    this.X = x;
    this.Y = y;

    if (this.X === undefined)
      this.X = 0;
    if (this.Y === undefined)
      this.Y = 0;

  }

  //Methods-----------------
  TeamDetailGraph.prototype.append = function () {
    var self = this;
    self.Group = self.Canvas.append('g').classed('team-detail-graph',
        true)
      .attr('transform', function () {
        return 'translate(' + self.X + ', ' + self.Y + ')';
      });

    self.Group.append('svg:text')
      .text('Team ' + self.Team.Name)
      .classed('team-graph-title', true)
      .attr('transform', function () {
        return 'translate(' + 16 + ', ' + 16 + ')';
      });

    function getTranslate(i) {
      var px = 32;
      if (i % 2 !== 0) {
        px += canvas.Width / 2;
      }
      var py = (Math.floor(i / 2) + 1) * 120;
      return 'translate(' + px + ', ' + py + ')';
    }

    function textTranslate(y) {
      return 'translate(32, ' + y + ')';
    }

    for (var i in self.Team.Players) {
      //creates new group to display player info
      var pinfo = self.Group.append('g').classed('team-player-info',
          true)
        .attr('transform', getTranslate(i));
      var mplayer = self.Team.Players[i];

      pinfo.append('svg:text').classed('team-player-info-title', true)
        .text(
          mplayer.Name).attr('transform', textTranslate(4));
      pinfo.append('svg:text').classed('team-player-info', true).text(
        'Total Gold: ' + mplayer.TotalGold).attr('transform',
        textTranslate(20));
      pinfo.append('svg:text').classed('team-player-info', true).text(
        'Total XP: ' + mplayer.TotalXP).attr('transform',
        textTranslate(
          36));
      pinfo.append('svg:text').classed('team-player-info', true).text(
        'Level: ' + mplayer.Level).attr('transform', textTranslate(
        52));
      pinfo.append('svg:text').classed('team-player-info', true).text(
        'Nation: ' + mplayer.Nation).attr('transform',
        textTranslate(68));
    }

  };

  TeamDetailGraph.prototype.remove = function () {
    this.Group.remove();
    this.Group = null;
  };

  function PlayerMatchGraph(canvas, match, player, scale, x, y) {
    //Attributes---------------------------------------------------------------
    this.Canvas = canvas;
    if (this.Canvas.ClassType === 'Canvas')
      this.Canvas = canvas.getCanvas();
    this.Player = player;
    this.Scale = scale;
    this.X = x;
    this.Y = y;
    this.Group = null;
    this.StatusTokensGroup = null;

    if (this.X === undefined)
      this.X = 0;
    if (this.Y === undefined)
      this.Y = 0;

  }

  //Methods---------------
  PlayerMatchGraph.prototype.append = function () {
    var self = this;

    var gX = self.X;
    var gY = self.Y;

    self.Group = self.Canvas.append('g')
      .classed('player-match-graph', true)
      .attr('transform', function () {
        return 'translate(' + gX + ', ' + gY + ')';
      });

    self.Group.append('svg:text').text('Player Match History')
      .classed('player-match-title', true)
      .attr('transform', function () {
        return 'translate(4, 32)';
      });

    self.Group.append('svg:text').text(self.Player.Name)
      .classed('player-match-name', true)
      .attr('transform', function () {
        return 'translate(32, 96)';
      });

    //Append status tokens
    self.StatusTokensGroup = self.Group.append('g').classed(
      'status-tokens-group', true);

    for (var i in self.Player.Status) {
      var status = self.Player.Status[i];
      var tx = self.Scale(status[0]);
      var ty = 0;
      switch (status[1]) {
        //TODO: adjust this to adapt to the canvas size
      case 'frag':
        ty = 4;
        break;
      case 'gold':
        ty = 64;
        break;
      case 'death':
        ty = 124;
        break;
      }
      if (data.DEBUG === true)
        console.log('Status: ' + status);
      var token = new StatusToken(self.StatusTokensGroup, status[1],
        tx, ty);
      token.append();
    }

    //put status token group on a feasible position
    self.StatusTokensGroup.attr('transform', function () {
      var stgX = 0;
      var stgY = gY + 180;

      return 'translate(' + stgX + ', ' + stgY + ' )';
    });

    //put the axis
    var axis = new TimeAxis(self.Group, gY + 380, 'bottom', self.Scale,
      5);
    axis.append();
  };

  PlayerMatchGraph.prototype.remove = function () {
    this.Group.remove();
    this.Group = null;
  };

  function ResourceListGraph(canvas, team, resource, scaleX, scaleY, x, y) {
    //Attributes------------
    this.Canvas = canvas;
    if (this.Canvas.ClassType === 'Canvas')
      this.Canvas = canvas.getCanvas();
    this.Team = team;
    this.ScaleX = scaleX;
    this.ScaleY = scaleY;
    this.X = x || 0;
    this.Y = y || 0;
    this.TeamResGroup = null;

    //parent resource, if any (like a player thumbnail or so. Usualy a single resource)
    this.ParentResource = '';
    //interest resource, mandatory (the actual resource, like items, etc. Usualy a list)
    this.InterestResource = resource || '';


    this.ClassType = 'ResourceListGraph';

    if (canvas === undefined || team === undefined || resource ===
      undefined)
      console.error("ERROR, required param is undefined in " + this + "!");
  }

  //Methods------------------
  ResourceListGraph.prototype.setInterest = function (interest, parent) {
    this.ParentResource = parent;
    this.InterestResource = interest;
  };
  ResourceListGraph.prototype.append = function () {
    var self = this;

    self.TeamResGroup = self.Canvas.append('g')
      .classed('team-resource-group', true)
      .attr('transform', function () {
        return 'translate(' + self.X + ',' + self.Y + ')';
      });
    var nPlayers = self.Team.Players.length;
    for (var i in self.Team.Players) { //loops through players to show resources
      var resGroup = self.TeamResGroup.append('g')
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
        .classed('resource-interest-group', true)
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
          .classed('parent-resource', true)
          .attr('width', self.ScaleX(0.4))
          .attr('height', self.ScaleY(0.4))
          .attr('x', self.ScaleX(j / 2))
          .attr('y', 4)
          .attr('xlink:href', src);
      }
    }
  };

  ResourceListGraph.prototype.remove = function () {
    this.TeamResGroup.remove();
  };

  function MatchResultsGraph(canvas, match, scaleX, scaleY, x, y) {
    //Attributes
    this.Canvas = canvas;
    if (this.Canvas.ClassType === 'Canvas')
      this.Canvas = canvas.getCanvas();
    this.Match = match;
    this.ScaleX = scaleX;
    this.ScaleY = scaleY;
    this.X = x || 0;
    this.Y = y || 0;
    this.ResultsGroup = null;

    this.ClassType = 'MatchResultsGraph';

    if (canvas === undefined || match === undefined || scaleX ===
      undefined || scaleY === undefined)
      console.error("ERROR, required param is undefined in " + this.ClassType +
        "!");
  }

  //Methods----------
  MatchResultsGraph.prototype.append = function () {
    var self = this;
    //append results group
    self.ResultsGroup = self.Canvas.append('g')
      .classed('end-results', true)
      .attr('transform', function () {
        return 'translate(' + self.X + ',' + self.Y + ')';
      });
    //appends team info and data
    var teamGroup = self.ResultsGroup.selectAll('g')
      .data([self.Match.Team[0], self.Match.Team[1]])
      .enter()
      .append('g')
      .classed('team-result-group', true)
      .attr('transform', function (d, i) {
        //TODO: fix this fixed value scale
        var y = i === 0 ? 0 : 3.5;
        return 'translate(' + self.ScaleX(0) + ',' + self.ScaleY(y) +
          ')';
      });
		//TODO: FIX THIS TO BE RELATIVE (TSPANS)
    teamGroup.append('text')
				      .classed('team-player-info-title', true)
				      .text(function (d) {return d.Name + ' Team -';});
		teamGroup.append('text')
							.classed('team-player-info', true)
							.text('Average Level:')
							.attr('transform', function(d){
								return 'translate('+self.ScaleX(0.8)+',0)';
							});
		teamGroup.append('text')
							.classed('team-player-info-value', true)
							.text(function(d, i){
								return self.Match.Team[i].AverageLevel;
								})
							.attr('transform', function(){
								return 'translate('+self.ScaleX(1.7)+',0)';
							});
		teamGroup.append('text')
							.classed('team-player-info', true)
							.text('Gold:')
							.attr('transform', function(d){
								return 'translate('+self.ScaleX(2.3)+',0)';
							});
		teamGroup.append('text')
							.classed('team-player-info-value', true)
							.text(function(d, i){
								return self.Match.Team[i].Gold;
								})
							.attr('transform', function(){
								return 'translate('+self.ScaleX(2.65)+',0)';
							});
		teamGroup.append('text')
							.classed('team-player-info', true)
							.text('Kills:')
							.attr('transform', function(d){
								return 'translate('+self.ScaleX(3.3)+',0)';
							});
		teamGroup.append('text')
							.classed('team-player-info-value', true)
							.text(function(d, i){
								return self.Match.Team[i].NumKills;
								})
							.attr('transform', function(){
								return 'translate('+self.ScaleX(3.7)+',0)';
							});
    //append player names (and thumbnail if available TODO) and group of info
		var texts = teamGroup.append('text').attr('transform', function(){return 'translate(12,0)';});
		var names = texts.selectAll('text')
											.data(function(d,i){return self.Match.Team[i].Players;})
											.enter()
											.append('tspan')
											.classed('team-player-info-value', true)
											.text(function(d,i){
												var str = d.Name.substr(0, 24);
												if(d.Name.length > 24)
													str += '...';
												return str;
											})
											.attr('dy', '3em')
											.attr('x', '0');

		//append info requested in a text fashion
		names.append('tspan').text(function(d){return 'Gold: ' + d.CurrentGold;}).attr('x', '18em');
		names.append('tspan').text(function(d){return 'Level: ' + d.Level;}).attr('x', '26em');
		names.append('tspan').text(function(d){return 'K:  ' + d.CurrentKills;}).attr('x', '36em');
		names.append('tspan').text(function(d){return 'D: ' + d.CurrentDeaths;}).attr('x', '40em');
		names.append('tspan').text(function(d){return 'A: ' + d.CurrentAssists;}).attr('x', '44em');
  };

  MatchResultsGraph.prototype.remove = function () {

  };

  //returns variables and classes
  return {
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
});
