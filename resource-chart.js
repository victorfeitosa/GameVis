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

  var resourceChart = new gamevis.graphics.ResourceListGraph({
    canvas: canvas,
    team: gdata.GameTeams[0],
    resource: 'Item',
    scaleX: scaleX,
    scaleY: scaleY,
    x: 0,
    y: 0
  });
  resourceChart.setInterest('Item', 'Hero');


  resourceChart.append();
  resourceChart.toolTips('parent', ['Anti Mage', 'Axe', 'Bane', 'Blood Seeker', 'Crystal Maiden']);
});
