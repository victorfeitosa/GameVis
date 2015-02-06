define(function (require) {
	require('d3/d3.v3');

	gamevis = {};
	gamevis.data = require('gamevis/data');
	gamevis.graphics = require('gamevis/graphics');
	gamevis.driver = require('drivers/dotadriver');

	canvas = new gamevis.data.Canvas(640, 480, "#666666", "TEXT");
	canvas.append();

	//Creates scales for this canvas
	scaleX = d3.scale.linear();
	scaleX.domain([0, 4]).range([40, 600]);

	scaleY = d3.scale.linear();
	scaleY.domain([0, 6]).range([20, 460]);

	d = new gamevis.driver();
	data = d.buildData('./gamevis/matches/players.json');

	console.log('Successfully loaded the stuff needed\n');
});
