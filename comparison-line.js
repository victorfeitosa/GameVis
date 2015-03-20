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

  var lineGraph = new gamevis.graphics.ComparisonGraphLine({
    canvas: canvas,
    match: myMatch,
    type: "Kills",
    x: 0,
    y: 0,
    scaleX: scaleX,
    scaleY: scaleY,
    ticks: true
  });
  lineGraph.build();
  lineGraph.append();
});
