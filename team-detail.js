//Import configuration and paths
requirejs.config({
  baseUrl: './',
  paths: {
    d3: './d3',
    gamevis: './gamevis',
    drivers: './gamevis/drivers',
    matchs: './gamevis/matchs'
  }
});

//Loads the game script
requirejs(['script'], function (require) {

  if (DEBUG === true) {
    console.log("Executed main script");
  }

  var PlayerC = new gamevis.data.Player({
    name: "Fido",
    rank: "Beginner",
    team: "A",
    nation: "Soviet Russia",
    tgold: 350,
    txp: 410,
    level: 1
  });
  var PlayerD = new gamevis.data.Player({
    name: "Purge",
    rank: "Beginner",
    team: "A",
    nation: "Outworld",
    tgold: 3250,
    txp: 4100,
    level: 12
  });
  var PlayerE = new gamevis.data.Player({
    name: "Domy",
    rank: "Beginner",
    team: "A",
    nation: "The Radiant",
    tgold: 120,
    txp: 40,
    level: 9
  });

  //add players to teams
  TeamA.addPlayer(PlayerC);
  TeamA.addPlayer(PlayerD);
  TeamA.addPlayer(PlayerE);

  var detailGraph = new gamevis.graphics.TeamDetailGraph({
    canvas: canvas,
    team: TeamA,
    x: 0,
    y: 0
  });
  detailGraph.append();
});
