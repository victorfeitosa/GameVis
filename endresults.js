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

  var graph = new gamevis.graphics.MatchResultsGraph(canvas, gdata.GameMatches[0], scaleX, scaleY, 0, 0);
  graph.append();

    var poly = new gamevis.graphics.StatPolygon({canvas: canvas, stats: {'Strength': 72, 'Agility': 10, 'Inteligence': 62, 'Constitution' : 43, 'Charisma': 55}, radius: 80, maxval: 80, x: 80, y: 80});
  poly.append();

});
