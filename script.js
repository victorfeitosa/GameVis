define(function (require) {
	gamevis = {};

	require('d3/d3.v3');

	gamevis.data = require('./gamevis/data');
	gamevis.graphics = require('./gamevis/graphics');
	gamevis.driver = require('drivers/dotadriver');

	canvas = new gamevis.data.Canvas({width: 640, height: 480});
	canvas.append();

	//Creates scales for this canvas
	scaleX = d3.scale.linear();
	scaleX.domain([0, 4]).range([40, 600]);

	scaleY = d3.scale.linear();
	scaleY.domain([-15, 15]).range([20, 460]);

	//Create the Players to test the stuff
	PlayerA = new gamevis.data.Player({name: "Moai", rank: "Beginner", team: "A",
	nation: "Fire-Nation", tgold: 3250, txp: 4100, level: 3});
	PlayerB = new gamevis.data.Player({name: "Johnny", rank: "Beginner", team: "B",
	nation: "Minas Tirith", tgold: 3100, txp: 4150, level: 3});

	//Create Teams to test the stuff
	TeamA = new gamevis.data.Team({name: "BadWolfs", rank: "Beginner", nation: "Avatar"});
	TeamB = new gamevis.data.Team({name: "RisingDudes", rank: "Beginner", nation: "LOTR"});
	//add players to teams
	TeamA.addPlayer(PlayerA);
	TeamB.addPlayer(PlayerB);

	//Create Match to test the stuff
	myMatch = new gamevis.data.Match({team1: TeamA, team2: TeamB, endtime: 5});

	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.addPlayerGold(TeamA, PlayerA, 300);
	myMatch.update();


	myMatch.addPlayerGold(TeamA, PlayerA, 300);
	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.update();


	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.addPlayerGold(TeamA, PlayerA, 300);
	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.update();

	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.addPlayerKill(TeamB, TeamA, PlayerB, PlayerA);
	myMatch.update();

	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);
	myMatch.addPlayerKill(TeamA, TeamB, PlayerA, PlayerB);

	myMatch.update();

	var d = new gamevis.driver();
	console.log(d.buildData('./gamevis/matches/players.json'));

	// var l = [];
	//
	// l.push(parseInt(d.convertID(89394976)));
	// l.push(parseInt(d.convertID(2917861)));
	// l.push(parseInt(d.convertID(87543472)));
	// l.push(parseInt(d.convertID(93072686)));
	// l.push(parseInt(d.convertID(90775042)));
	// l.push(parseInt(d.convertID(53764543)));
	// l.push(parseInt(d.convertID(135870975)));
	// l.push(parseInt(d.convertID(4294967295)));
	// l.push(parseInt(d.convertID(4294967295)));
	// l.push(parseInt(d.convertID(131919910)));
	//
	// console.log(l);
});
