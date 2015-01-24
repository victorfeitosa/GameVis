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

	if (DEBUG === true) {
		console.log("Executed main script");
	}

	var PlayerC = new gamevis.data.Player("Fido", "Beginner", "A", "Soviet Russia", 350, 410,
		1);
	var PlayerD = new gamevis.data.Player("Purge", "Beginner", "A", "Outworld", 3250, 4100,
		12);
	var PlayerE = new gamevis.data.Player("Domy", "Beginner", "A", "The Radiant", 120, 40, 9);

	//add players to teams
	TeamA.addPlayer(PlayerC);
	TeamA.addPlayer(PlayerD);
	TeamA.addPlayer(PlayerE);

	var detailGraph = new gamevis.graphics.TeamDetailGraph(canvas, TeamA, 0, 0);
	detailGraph.append();
});
