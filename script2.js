define(function (require) {
  gamevis = require('gamevis/gamevis.min-');
  gamevis.driver = require('drivers/dotadriver');

  canvas = new gamevis.data.Canvas({
    width: screen.width/3 * 2,
    height: screen.height/3 * 2,
		parent: '#canvas'
  });
  canvas.append();

  //Creates scales for this canvas
  scaleX = d3.scale.linear();
  scaleX.domain([0, 4]).range([canvas.Width/20, canvas.Width - canvas.Width/20]);

  scaleY = d3.scale.linear();
  scaleY.domain([0, 6]).range([canvas.Height/20, canvas.Height - canvas.Height/20]);

  d = new gamevis.driver();
  gdata = d.buildData('./gamevis/matches/players.json');

  // console.log(gdata);

  console.log('Successfully loaded the stuff needed\n');

});
