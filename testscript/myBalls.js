//this is a test file that shows the definition of a module with two classes
//one has a attribute and the other a method, the group of classes is exported
//later

define(function () {
	function ClassOne(){
		var self = this;
		self.Name = "Class One Name";
	}

	function ClassTwo(){
		var self = this;
		self.execute = function(){console.log("EXECUTING");};
	}

	return {ClassOne:ClassOne, ClassTwo:ClassTwo};
});
