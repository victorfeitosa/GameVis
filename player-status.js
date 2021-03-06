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

  var playerMatchGraph = new gamevis.graphics.PlayerMatchGraph({canvas: canvas, match: myMatch, player: PlayerA, scale: scaleX, x: 0, y: 0});
  playerMatchGraph.append();
});
