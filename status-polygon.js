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
requirejs(['gamevis/statpolygon.js'], function () {

  var canvas_polygon = new gamevis.data.Canvas({
    width: screen.width / 3,
    height: screen.height / 3,
    parent: '#canvas-polygon'
  });
  canvas_polygon.append();

  var poly = new gamevis.graphics.StatPolygon({
  	canvas: canvas_polygon,
  	stats: {
  		'STR': 72,
  		'AGI': 10,
  		'INT': 62,
  		'CON': 43,
  		'CHA': 55
  	},
  	radius: 80,
  	maxval: 80,
  	x: 200,
  	y: 120,
    spacing: 5
  });

  poly.append();

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
