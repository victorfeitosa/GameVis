define(function (require) {
  gamevis = {};

  require('d3/d3');

  gamevis.data = require('./gamevis/data');
  gamevis.graphics = require('./gamevis/graphics');
  gamevis.driver = require('drivers/dotadriver');

  canvas = new gamevis.data.Canvas({
    width: 640,
    height: 480
  });
  canvas.append();

  //Creates scales for this canvas
  scaleX = d3.scale.linear()
                    .domain([0, 14])
                    .range([40, 600]);

  scaleY = d3.scale.linear();
  scaleY.domain([-15, 15]).range([20, 460]);

  //Create the Players to test the stuff
  PlayerA = new gamevis.data.Player({
    name: "Moai",
    rank: "Beginner",
    team: "A",
    nation: "Fire-Nation",
    tgold: 3250,
    txp: 4100,
    level: 3
  });
  PlayerB = new gamevis.data.Player({
    name: "Johnny",
    rank: "Beginner",
    team: "B",
    nation: "Minas Tirith",
    tgold: 3100,
    txp: 4150,
    level: 3
  });

  //Create Teams to test the stuff
  TeamA = new gamevis.data.Team({
    name: "BadWolfs",
    rank: "Beginner",
    nation: "Avatar"
  });
  TeamB = new gamevis.data.Team({
    name: "RisingDudes",
    rank: "Beginner",
    nation: "LOTR"
  });
  //add players to teams
  TeamA.addPlayer(PlayerA);
  TeamB.addPlayer(PlayerB);

  //Create Match to test the stuff
  myMatch = new gamevis.data.Match({
    team1: TeamA,
    team2: TeamB,
    endtime: 15
  });

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
  myMatch.update();

  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);

  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerGold(TeamA, PlayerA, 300);
  myMatch.addPlayerGold(TeamB, PlayerB, 150);
  myMatch.update();

  myMatch.update();
  myMatch.update();

  myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
  myMatch.update();

  myMatch.addPlayerGold(TeamA, PlayerA, 300);
  myMatch.addPlayerGold(TeamA, PlayerA, 250);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.update();

  myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
  myMatch.addPlayerGold(TeamB, PlayerB, 1250);
  myMatch.update();
});
