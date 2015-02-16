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

//Executes some stuff
requirejs(['script2'], function () {

  var graph = new gamevis.graphics.MatchResultsGraph(canvas, data.GameMatches[0], scaleX, scaleY, 0, 0);
  graph.append();
});
