//*******************************************************************************************************************************************
//Game stuctures*****************************************************************************************************************************
//*******************************************************************************************************************************************

//DONE: Geerate unique id for each player

//--IMPORTANT--
//TODO: Implement LoadDB and SaveDB global functions
//TODO: Create a game data sctructure
//TODO: Modularize the data format exchange to read/write JSON for every graph data
//TODO: Create a 'plugin' class to read the data formats and translate them to the graphs
//TODO: Add implementation of the realtime match and to the realtime graphs (make this easier to read)

//TODO: insert NodeJs into the code to save/load data and perform server related operations

//'Globals'
var CurrentPlayerID = 0;
var CurrentTeamID = 0;
var CurrentMatchID = 0;

function LoadDataBase(src) {
  //TODO: Implement this

}

function SaveDataBase(dest) {
  //TODO: Implement this

}

//Canvas class----------------------------------------------------
function Canvas(width, height, label, bgcolor) {

  var self = this; //self variable to maintain the class auto-reference

  self.Width = width;
  self.Height = height;
  self.BGColor = bgcolor;
  self.Label = label;
  self.SVGCanvas = null;
  self.ClassType = "Canvas";

  self.append = function() {
    //check missing stuff
    if (self.Width === undefined)
      self.Width = 640;
    if (self.Height === undefined)
      self.Height = 480;
    if (self.Label === undefined)
      self.Label = "Game Graph:";

    //actual appending
    if (self.SVGCanvas === null) {
      self.SVGCanvas = d3.select("body").append("svg")
        .attr("width", self.Width)
        .attr("height", self.Height)
        .classed("canvas", true);

      if (isStyleSourceCode()) {
        if (self.BGColor === undefined)
          self.BGColor = "0xAAAAAA";
      }
    }
  };

  self.remove = function() {
    if (self.SVGCanvas !== null)
      self.SVGCanvas.remove();
  };

  self.getCanvas = function() {
    return self.SVGCanvas;
  };
}

//Player Class-------------------------------------------------------------------------------------------------------------------------------
function Player(name, rank, team, nation, tgold, txp, level) {
  //Attributes------------------------------------------------------------

  var self = this; //self variable to maintain the class auto-reference

  //Global attributes
  CurrentPlayerID = CurrentPlayerID + 1;
  self.ID = CurrentPlayerID;
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
  self.print = function() {
    console.log("Name: " + self.Name);
    console.log("Rank: " + self.Rank);
    console.log("Team: " + self.Team);
    console.log("Nation: " + self.Nation);
    console.log("Total Gold: " + self.TotalGold);
    console.log("Total XP: " + self.TotalXP);
  };

  self.addDeath = function(time) {
    self.CurrentDeaths++;
    self.CurrentGold -= 100 + time;
    self.TotalGold -= 100 + time;

    //reality check
    if (self.CurrentGold < 0)
      self.CurrentGold = 0;
    if (self.TotalGold < 0)
      self.TotalGold = 0;

    self.Status.push([time, "Death"]);
  };

  self.addGold = function(time, amount) {
    self.CurrentGold += amount;
    self.TotalGold += amount;
    self.Status.push([time, "Gold"]);
  };

  self.addXP = function(amount) {
    self.CurrentXP += amount;
    self.TotalXP += amount;
  };

  self.addKill = function(time) { //adds a kill, xp and gold and informs who was killed
    self.CurrentKills++;
    self.addXP(200);

    self.CurrentGold += 250;
    self.TotalGold += 250;

    self.Status.push([time, "frag"]);
  };
}

//Team Class---------------------------------------------------------------------------------------------------------------------------------
function Team(name, rank, nation) {
  //Attributes-----------------------------------------------------------------

  var self = this;

  CurrentTeamID = CurrentTeamID + 1;
  self.ID = CurrentTeamID;
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
  self.getAverageLevel = function() {
    var n = 0;
    for (var i in self.Players) {
      n += self.Players[i].Level;
    }

    n /= Players.length;

    return n;
  };

  self.getKills = function() {
    var n = 0;
    for (var i in self.Players) {
      n += self.Players[i].CurrentKills;
    }

    self.NumKills = n;

    return n;
  };

  self.getDeaths = function() {
    var n = 0;
    for (var i in self.Players) {
      n += self.Players[i].CurrentDeaths;
    }

    return n;
  };

  self.getXP = function() {
    var n = 0;
    for (var i in self.Players) {
      n += self.Players[i].CurrentXP;
    }

    return n;
  };

  self.getGold = function() {
    var n = 0;
    for (var i in self.Players) {
      n += self.Players[i].CurrentGold;
    }

    self.Gold = n;

    return n;
  };

  //add/remove  Players
  self.addPlayer = function(player) {
    self.Players.push(player);
  };

  self.removePlayer = function(ppos) {
    self.Players.splice(ppos, 1);
  };

  self.print = function() {
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

  CurrentMatchID = CurrentMatchID + 1;
  self.ID = CurrentMatchID;
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
  self.init = function() {
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
  self.addPlayerKill = function(killerTeam, victimTeam, killer, victim) {

    if ((killer.ClassType === "Player" && victim.ClassType === "Player") &&
      (killerTeam.ClassType === "Team" && victimTeam.ClassType === "Team") &&
      self.CurrentTime < self.EndTime) {
      killer.addKill(self.CurrentTime);
      victim.addDeath(self.CurrentTime);
      killerTeam.getKills();
      victimTeam.getDeaths();

    }
  };

  self.addPlayerGold = function(team, player, amount) {
    if (self.CurrentTime < self.EndTime) {
      player.addGold(self.CurrentTime, amount);
      team.getGold();
    }
  };

  self.addPlayerXP = function(team, player, amount) {
    if (self.CurrentTime < self.EndTime) {
      player.addXP(amount);
      team.getXP();
    }
  };

  self.getMatchTime = function(time) {
    return self.CurrentTime;
  };

  //return differences according to time
  self.calculateDifference = function(time, what) {
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

  self.getDifference = function(time, what) {
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

  //reappends the match status adding kills, gold, etc
  self.reappend = function() {
    var time = self.CurrentTime;
    if (time <= self.EndTime) {
      self.GoldDifference.push(self.calculateDifference(time, "Gold"));
      self.XPDifference.push(self.calculateDifference(time, "XP"));
      self.KillDifference.push(self.calculateDifference(time, "Kills"));

      self.CurrentTime++;
    }
  };

  self.build = function() {
    //TODO: For this to work we have to change the methods of adding kills and gold so the-----
    //		build works properly, building the graphics with values on the correct timestamps--
    //		and not always on '0'.-------------------------------------------------------------

    for (var time = 0; time < self.EndTime; time++) {
      self.GoldDifference.push(self.calculateDifference(time, "Gold"));
      self.XPDifference.push(self.calculateDifference(time, "XP"));
      self.KillDifference.push(self.calculateDifference(time, "Kills"));
    }
  };

  self.update = function() {
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
  CurrentMatchID = CurrentMatchID + 1;
  self.ID = CurrentMatchID;
  self.ClassType = "RealTimeMatch";
  self.Team1 = team1;
  self.Team2 = team2;

  self.CurrentTime = 0;
  self.Ended = false;

  self.GoldDifference = [];
  self.XPDifference = [];
  self.KillDifference = [];


  //Methods-------------------------------------------------------------------------

  self.getCurrentTime = function() {
    return self.CurrentTime;
  };

  self.reappend = function() {

  };


}
