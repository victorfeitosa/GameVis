//this is a test file that shows the definition of a module with two classes
//one has a attribute and the other a method, the group of classes is exported
//later

define(function () {
  function ClassThree(){
    var self = this;
    self.Name = "Class 3 Name";
  }

  function ClassFour(){
    var self = this;
    self.execute = function(){console.log("EXECUTING 444");};
  }

  return {ClassThree:ClassThree, Four:ClassFour};
});
