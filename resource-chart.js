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

  var resourceChart = new gamevis.graphics.ResourceListGraph(canvas, gdata.GameTeams[0], 'Item', scaleX, scaleY, 0, 0);
  resourceChart.setInterest('Item', 'Hero');


  resourceChart.append();
});
