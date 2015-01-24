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

	var lineGraph = new gamevis.graphics.ComparisonGraphLine(canvas, myMatch, "Kills", 0, 0,
		scaleX, scaleY);
	lineGraph.build();
	lineGraph.append();
});
