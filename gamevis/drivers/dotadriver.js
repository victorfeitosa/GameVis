//Dota2 Driver definition and implementation
//Dota2 plugin that converts a Dota2 Game JSON to a GameVis JSON

define(function (require) {

  BaseDriver = require('drivers/basedriver');
  data = require('gamevis/data');

  DotaDriver.prototype = new BaseDriver();
  DotaDriver.prototype.constructor = DotaDriver;

  function DotaDriver() {
    var self = this;

    self.ID = 1;
    self.SourceGame = 'Dota 2';

    self.httpGet = function (theUrl) {
      var xmlHttp = null;

      xmlHttp = new XMLHttpRequest();
      xmlHttp.open("GET", theUrl, false); //false is set so the file is not streamed
      xmlHttp.send(null);

      return xmlHttp.responseText;
    };

    //Converts 32bit ids of Steam to 64bit ids used in most cases...
    self.convertId = function (id) {
      var converted = '';

      if (id.length === 17) {
        converted = (parseInt(id.substr(3)) - 61197960265728).toString();
      } else {
        var intid = parseInt(id);
        intid = intid + 61197960265728;
        intid = intid.toString();
        converted = '765' + intid;
      }

      return converted;
    };
  }

  /**jshint multistr:true**/
  DotaDriver.prototype.Description =
    "This is a driver for the Dota2 game.\nThis " +
    "code gets a Valve match data in XML or JSON " +
    "and converts it into a GameVis GameData or " +
    "JSON/XML format.";

  //Set options for the driver data building and converting
  DotaDriver.prototype.setOptions = function (optArray) {
    //TODO: implement this
    //options: []
  };

  //Builds data from a source into a GameData object
  DotaDriver.prototype.buildData = function (src) {
    var gamedata = new data.GameData();

    //Since this is a mockup driver, the src is not used, instead this is hardcoded
    var jsonmatch = JSON.parse(this.httpGet('/gamevis/matches/match.json'))
      .result;
    var jsonplayers = JSON.parse(this.httpGet(
        '/gamevis/matches/players.json'))
      .response;
    //gets heroes and items list
    var jsonitems = JSON.parse(this.httpGet(
      '/gamevis/matches/items.json'));
    var jsonheroes = JSON.parse(this.httpGet(
      '/gamevis/matches/heroes.json'));
    var jsonabilities = JSON.parse(this.httpGet(
      '/gamevis/matches/abilities.json'));

    //TODO: parse json objecta to gamedata object
    gamedata.setGameName('Dota2 Match ' + jsonmatch.match_id);
    gamedata.setGameId(0);
    gamedata.setGameCategory('MOBA');
    gamedata.setGameDescription(
      "Dota2 is a MOBA game by Valve and IceFrog. " +
      "\nIt is the sequel to the Warcraft 3 mod " +
      "Defense Of The Ancients and it's one of " +
      "the most popular game of all time.");
    //add players, teams and matches
    var radiant = new data.Team('Radiant', 0, 'radiant');
    var dire = new data.Team('Dire', 0, 'dire');
    for (var i in jsonmatch.players) {
      //create a player, assign its stuff and add him to the players list
      var p = new data.Player();
      p.ID = this.convertId(jsonmatch.players[i].account_id);

      p.Name = undefined;
      p.Rank = 0;
      p.Nation = undefined;
      //finds player name (or not)
      for (var j in jsonplayers.players) {
        if (p.ID === jsonplayers.players[j].steamid) {
          p.Name = jsonplayers.players[j].personaname;
          p.Rank = jsonplayers.players[j].communityvisibilitystate;
          p.Nation = jsonplayers.players[j].loccountrycode;
          p.Thumbnail = jsonplayers.players[j].avatarfull;

          break;
        }

        if(p.Name === undefined){
          var pslot = jsonmatch.players[i].player_slot + 1;
          pslot = pslot > 128 ? pslot-123:pslot;
          p.Name = 'Player ' + pslot;
        }
      }
      if (jsonmatch.players[i].player_slot < 5) {
        p.Team = 'Radiant';
        radiant.addPlayer(p);
      } else {
        p.Team = 'Dire';
        dire.addPlayer(p);
      }
      p.TotalGold = jsonmatch.players[i].gold_spent + jsonmatch.players[i]
        .gold;
      p.CurrentGold = jsonmatch.players[i].gold;
      p.Level = jsonmatch.players[i].level;
      p.TotalXP = jsonmatch.players[i].xp_per_min * (jsonmatch.duration /
        60);
      p.CurrentXP = p.TotalXP;
      p.CurrentKills = jsonmatch.players[i].kills;
      p.CurrentDeaths = jsonmatch.players[i].deaths;
      p.CurrentAssists = jsonmatch.players[i].assists;

      //add skills/level progression and heroes stuff
      p.addResourceGroup('Hero');
      p.addResourceGroup('Item');
      p.addResourceGroup('Skill');

      //get hero list and item list
      //Hero
      for (var j in jsonheroes.heroes) {
        if (jsonmatch.players[i].hero_id === jsonheroes.heroes[j].id) {
          var iconuri = 'http://cdn.dota2.com/apps/dota2/images/heroes/' +
            (jsonheroes.heroes[i].name.replace('npc_dota_hero_', '')) + '_full.png';
          p.addResource('Hero', new data.Resource(jsonheroes.heroes[j].id,
            jsonheroes.heroes[i].localized_name, 'hero', iconuri), -1);
        }
      }
      //Item
      for (var j = 0; j < 6; j++) {
        var item = 'item_' + j;
        var itid = jsonmatch.players[i][item];

        if (itid !== 0) {
          var iconuri = 'http://cdn.dota2.com/apps/dota2/images/items/' +
            jsonitems[itid].name + '_lg.png';
          p.addResource('Item', new data.Resource(jsonmatch.players[i][
              item
            ],
            jsonitems[itid].localized_name, 'item', iconuri), j);
        } else {
          p.addResource('Item', new data.Resource(0, 'No Item', 'item',
            ''), j);
        }
      }
      //Skills
      for (var j in jsonmatch.players[i].ability_upgrades) {
        var abilityid = jsonmatch.players[i].ability_upgrades[j].ability;
        var ability = null;
        for (var k in jsonabilities.abilities) {
          if (abilityid === parseInt(jsonabilities.abilities[k].id)) {
            ability = jsonabilities.abilities[k];
          }
        }

        if (ability !== null) {
          var iconuri =
            'http://cdn.dota2.com/apps/dota2/images/abilities/' + ability
            .name + '_hp1.png';
          var resource = new data.Resource(parseInt(ability.id), ability.name,
            'skill', iconuri);
          p.addResource('Skill', resource, j);
        }
      }

      //add player to the player list in this game/match
      gamedata.addGamePlayer(p);
    }

    radiant.getGold();
    radiant.getDeaths();
    radiant.getKills();
    radiant.getXP();
    radiant.getAverageLevel();
    dire.getGold();
    dire.getDeaths();
    dire.getKills();
    dire.getXP();
    dire.getAverageLevel();

    gamedata.addGameTeam(radiant);
    gamedata.addGameTeam(dire);

    var match = new data.Match(radiant, dire, jsonmatch.duration);
    gamedata.addGameMatch(match);

    return gamedata;
  };

  //Returns a JSON/XML of the built GameData object
  DotaDriver.prototype.getConvertedData = function (gamedata, format) {
    //returns the built GameData as a JSON/XML
    return "";
  };

  return DotaDriver;
});
