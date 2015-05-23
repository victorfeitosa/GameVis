//Import configuration and paths
requirejs.config({
	baseUrl: './',
	paths: {
		d3: '/d3',
		gamevis: '/gamevis',
		drivers: '/gamevis/drivers',
		matchs: '/gamevis/matchs'
	}
});

//Executes some stuff
requirejs(['/script2.js'], function () {

	var graph = new gamevis.graphics.MatchResultsGraph({
		canvas: canvas,
		match: gdata.GameMatches[0],
		scaleX: scaleX,
		scaleY: scaleY,
		x: 0,
		y: 0
	});
	graph.append();

	// var poly = new gamevis.graphics.StatPolygon({
	// 	canvas: canvas,
	// 	stats: {
	// 		'Strength': 72,
	// 		'Agility': 10,
	// 		'Inteligence': 62,
	// 		'Constitution': 43,
	// 		'Charisma': 55
	// 	},
	// 	radius: 80,
	// 	maxval: 80,
	// 	x: 80,
	// 	y: 80
	// });
	//poly.append();

  //FIXME: this can be done but let it in the class for now
	// poly.get('scircle').filter('.dot-element').data(Object.keys(poly.Stats)).each(
	// 	function (d, i) {
	// 		var tick = d3.select(this);
	// 		var tip = new gamevis.graphics.ToolTip({
	// 				parent: tick,
	// 				tiphtml: d,
	// 				x: tick.attr('cx'),
	// 				y: tick.attr('cy')
	// 			})
	// 			.classed('mytooltip', true)
	// 			.on('mouseover', function () {
	// 				tip.transition().style('opacity', 0.9);
	// 			}).on('mouseout', function () {
	// 				tip.transition().style('opacity', 0);
	// 			});
	// 	});

});
