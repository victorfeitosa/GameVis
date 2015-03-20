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

	var barGraph = new gamevis.graphics.ComparisonGraphBar({canvas: canvas, match: myMatch,
		type: "Kills", x: 0, y: 0, scaleX: scaleX, scaleY: scaleY});
	barGraph.build();
	barGraph.append();

	barGraph.toolTips(['Zero', 'One', 'Two']);
});
