//Import configuration and paths
requirejs.config({
  baseUrl: './',
  paths: {
    d3: '/code/d3',
    gamevis: '/code/gamevis',
    drivers: '/code/gamevis/drivers',
    matchs: '/code/gamevis/matchs'
  }
});

//Executes some stuff
requirejs(['/code/script.js'], function () {

  //Creates canvases
  var canvas_line = new gamevis.data.Canvas({
    width: 640,
    height: 480,
    parent: '#canvas-line'
  });
  canvas_line.append();

  var canvas_bar = new gamevis.data.Canvas({
    width: 640,
    height: 480,
    parent: '#canvas-bar'
  });
  canvas_bar.append();

  var canvas_token = new gamevis.data.Canvas({
    width: 640,
    height: 480,
    parent: '#canvas-token'
  });
  canvas_token.append();

  //LineGraph code
  var lineGraph = new gamevis.graphics.ComparisonGraphLine({
    canvas: canvas_line,
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

  var kills = [];

  for (var i = 0; i < myMatch.getMatchTime(); i++){
    var kn = myMatch.getDifference(i, 'Kills');
    kills.push('Kill Difference: ' + kn);
  }
  lineGraph.toolTips(kills);

  //ComparisonBar code
	if (DEBUG === true) {
		console.log("Executed main script");
	}

	var barGraph = new gamevis.graphics.ComparisonGraphBar({canvas: canvas_bar, match: myMatch,
		type: "Kills", x: 0, y: 0, scaleX: scaleX, scaleY: scaleY});
	barGraph.build();
	barGraph.append();

	barGraph.toolTips(['Zero', 'One', 'Two']);

  //StatusToken code
  var playerMatchGraph = new gamevis.graphics.PlayerMatchGraph({canvas: canvas_token, match: myMatch, player: PlayerA, scale: scaleX, x: 0, y: 0});
  playerMatchGraph.append();
});
