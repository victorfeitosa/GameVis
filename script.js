define(function (require) {
  gamevis = {};

	require('d3/d3.v3');

  gamevis.data = require('./gamevis/data');
  gamevis.graphics = require('./gamevis/graphics');

  canvas = new gamevis.data.Canvas(640, 480, "#666666", "TEXT");
  canvas.append();

  //Creates scales for this canvas
  scaleX = d3.scale.linear();
  scaleX.domain([0, 4]).range([40, 600]);

  scaleY = d3.scale.linear();
  scaleY.domain([-15, 15]).range([20, 460]);

  //Create the Players to test the stuff
  PlayerA = new gamevis.data.Player("Moai", "Beginner", "A",
    "Fire-Nation", 3250,
    4100, 3);
  PlayerB = new gamevis.data.Player("Johnny", "Beginner", "B",
    "Minas Tirith", 3100,
    4150,
    3);

  //Create Teams to test the stuff
  TeamA = new gamevis.data.Team("BadWolfs", "Beginner", "Avatar");
  TeamB = new gamevis.data.Team("RisingDudes", "Beginner", "LOTR");
  //add players to teams
  TeamA.addPlayer(PlayerA);
  TeamB.addPlayer(PlayerB);

  //Create Match to test the stuff
  myMatch = new gamevis.data.Match(TeamA, TeamB, 5);

  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.addPlayerGold(TeamA, PlayerA, 300);
  myMatch.update();


  myMatch.addPlayerGold(TeamA, PlayerA, 300);
  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();


  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.addPlayerGold(TeamA, PlayerA, 300);
  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);

  myMatch.update();

  //var d = new DotaDriver();

  //var j = d.buildData("gamevis/matchs/match.json");
  //console.log(j);

  // var l = [];
  //
  // l.push(parseInt(d.convertID(89394976)));
  // l.push(parseInt(d.convertID(2917861)));
  // l.push(parseInt(d.convertID(87543472)));
  // l.push(parseInt(d.convertID(93072686)));
  // l.push(parseInt(d.convertID(90775042)));
  // l.push(parseInt(d.convertID(53764543)));
  // l.push(parseInt(d.convertID(135870975)));
  // l.push(parseInt(d.convertID(4294967295)));
  // l.push(parseInt(d.convertID(4294967295)));
  // l.push(parseInt(d.convertID(131919910)));
  //
  // console.log(l);
});
