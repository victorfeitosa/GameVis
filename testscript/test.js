//This is an example file that shows the importing of a lib file and the use
//of its classes methods and attributes

define(function(require){
  var lol = {};
  lol.myballs = require('./myBalls');
  lol.mydick = require('./myDick');

  var t = new lol.myballs.ClassOne();
  var p = new lol.myballs.ClassTwo();
  var k = new lol.mydick.Four();

  console.log(t.Name);
  p.execute();
  k.execute();
});
