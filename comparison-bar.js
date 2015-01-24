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

	//Actual Comparison-bar code
	if (DEBUG === true) {
		console.log("Executed main script");
	}

	var barGraph = new gamevis.graphics.ComparisonGraphBar(canvas, myMatch,
		"Kills", 0, 0, scaleX, scaleY);
	barGraph.build();
	barGraph.append();
});
